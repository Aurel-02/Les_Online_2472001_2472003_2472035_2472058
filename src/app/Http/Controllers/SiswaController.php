<?php

namespace App\Http\Controllers;

use App\Services\UserSession; 
use Illuminate\Http\Request;
use App\Pattern\DAO\VoucherDAO;
use App\Pattern\DAO\PaketPembelajaranDAO;
use App\Pattern\DAO\MateriDAO;

class SiswaController extends Controller
{
    protected $voucherDAO;
    protected $paketDAO;
    protected $materiDAO;

    public function __construct()
    {
        $this->voucherDAO = new VoucherDAO();
        $this->paketDAO = new PaketPembelajaranDAO();
        $this->materiDAO = new MateriDAO();
    }

    public function index()
    {
        $session = UserSession::getInstance();

        $userName  = $session->getName();
        $userEmail = $session->getEmail();
        $userRole  = $session->getRole();
        
        $user = $session->getUser();
        $userJenjang = $user ? $user->id_jenjang : 3;
        $photoProfile = $session->getPhotoProfile();

        $activities = collect();
        if ($user) {
            $activities = \App\Models\Activity::query()
                            ->where('user_id', $user->getKey())
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
        }

        // Fetch active vouchers using DAO
        $vouchers = $this->voucherDAO->getActiveVouchers();

        // Fetch active package remaining days using Proxy's RealAccess
        $activePackageName = null;
        $sisaHari = 0;
        
        if ($user) {
            $siswaAccess = new \App\Pattern\Proxy\SiswaRealAccess($user->id_user);
            $packageInfo = $siswaAccess->getActivePackageInfo();
            $sisaHari = $packageInfo['sisaHari'];
            $activePackageName = $packageInfo['activePackageName'];
        }

        return view('siswa.home', compact('userName', 'userEmail', 'userRole', 'userJenjang', 'photoProfile', 'activities', 'vouchers', 'activePackageName', 'sisaHari'));
    }

    public function daftarMateri(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        $mapel = $request->query('mapel', 'Matematika');
        
        $kelas = session('selected_kelas');
        $jurusan = session('selected_jurusan');
        
        $materis = $this->materiDAO->searchMateriWithGuruByJudul($mapel, $kelas, $jurusan);
            
        return view('siswa.materi', compact('userName', 'mapel', 'photoProfile', 'materis'));
    }
    public function chat(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        
        return view('siswa.chat', compact('userName', 'photoProfile'));
    }

    public function paketBelajar(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        
        $user = $session->getUser();
        $idJenjang = $user ? $user->id_jenjang : null;
        
        $jenjangName = null;
        if ($idJenjang) {
            $jenjangName = \Illuminate\Support\Facades\DB::table('jenjang')->where('id_jenjang', $idJenjang)->value('nama_jenjang');
        }

        $paketList = $this->paketDAO->getPaketsByJenjang($jenjangName);
        
        // Fetch active vouchers
        $vouchers = $this->voucherDAO->getActiveVouchers();

        // Fetch active package IDs for the current student
        $activePackageIds = [];
        if ($user) {
            $transactions = \Illuminate\Support\Facades\DB::table('transaksi')
                ->join('paket_pembelajaran', 'transaksi.id_paket', '=', 'paket_pembelajaran.id_paket')
                ->where('transaksi.id_user', $user->id_user)
                ->where('transaksi.status', 'berhasil')
                ->select('transaksi.id_paket', 'transaksi.created_at', 'paket_pembelajaran.masa_aktif')
                ->get();

            foreach ($transactions as $t) {
                $createdAt = new \DateTime($t->created_at);
                $now = new \DateTime();
                
                $createdTimestamp = $createdAt->getTimestamp();
                $nowTimestamp = $now->getTimestamp();
                $secondsActive = (int)$t->masa_aktif * 24 * 3600;

                if ($nowTimestamp < ($createdTimestamp + $secondsActive)) {
                    $activePackageIds[] = (int)$t->id_paket;
                }
            }
        }

        return view('siswa.paket_belajar', compact('userName', 'photoProfile', 'paketList', 'jenjangName', 'vouchers', 'activePackageIds'));
    }

    public function notifikasi(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        
        $user = $session->getUser();
        $activities = collect();
        if ($user) {
            $activities = \App\Models\Activity::query()
                            ->where('user_id', $user->getKey())
                            ->orderBy('created_at', 'desc')
                            ->get();
        }
        
        return view('siswa.notifikasi', compact('userName', 'photoProfile', 'activities'));
    }

    public function setKelas(Request $request)
    {
        $request->validate([
            'kelas' => 'required|integer',
            'jurusan' => 'nullable|string'
        ]);

        session(['selected_kelas' => $request->kelas]);
        
        if ($request->has('jurusan')) {
            session(['selected_jurusan' => $request->jurusan]);
        }
        
        return response()->json(['success' => true]);
    }

    public function storeTransaksi(Request $request)
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak terautentikasi.'], 401);
        }

        $request->validate([
            'id_paket' => 'required|integer',
            'id_voucher' => 'nullable|integer',
            'metode_pembayaran' => 'required|string',
        ]);

        // Instantiate Chain of Responsibility Context
        $context = new \App\Services\Checkout\CheckoutContext(
            $user->id_user,
            (int)$request->id_paket,
            $request->id_voucher ? (int)$request->id_voucher : null,
            $request->metode_pembayaran
        );

        // Build the Chain
        $packageValidation = new \App\Services\Checkout\PackageValidationHandler();
        $voucherValidation = new \App\Services\Checkout\VoucherValidationHandler();
        $paymentValidation = new \App\Services\Checkout\PaymentMethodValidationHandler();
        $transactionStorage = new \App\Services\Checkout\TransactionStorageHandler();

        $packageValidation
            ->setNext($voucherValidation)
            ->setNext($paymentValidation)
            ->setNext($transactionStorage);

        // Run the Chain
        $packageValidation->handle($context);

        if (!$context->isSuccess) {
            return response()->json([
                'success' => false,
                'message' => $context->errorMessage ?? 'Terjadi kesalahan saat memproses transaksi.'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pembelian paket belajar berhasil!',
            'subtotal' => $context->subtotal
        ]);
    }
}
