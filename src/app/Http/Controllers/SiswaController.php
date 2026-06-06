<?php

namespace App\Http\Controllers;

use App\Services\UserSession; 
use Illuminate\Http\Request;

class SiswaController extends Controller
{
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
            $activities = \App\Models\Activity::where('user_id', $user->getKey())
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
        }

        // Fetch active vouchers
        $vouchers = \Illuminate\Support\Facades\DB::table('voucher')
            ->where('tanggal_berakhir', '>=', now()->toDateString())
            ->get();

        // Fetch active package remaining days
        $activePackageName = null;
        $sisaHari = 0;
        if ($user) {
            $latestTransaction = \Illuminate\Support\Facades\DB::table('transaksi')
                ->join('paket_pembelajaran', 'transaksi.id_paket', '=', 'paket_pembelajaran.id_paket')
                ->where('transaksi.id_user', $user->id_user)
                ->where('transaksi.status', 'berhasil')
                ->orderBy('transaksi.id_transaksi', 'desc')
                ->first();

            if ($latestTransaction) {
                $createdAt = new \DateTime($latestTransaction->created_at);
                $now = new \DateTime();
                
                $createdTimestamp = $createdAt->getTimestamp();
                $nowTimestamp = $now->getTimestamp();
                $secondsActive = (int)$latestTransaction->masa_aktif * 24 * 3600;

                if ($nowTimestamp < ($createdTimestamp + $secondsActive)) {
                    $remainingSeconds = ($createdTimestamp + $secondsActive) - $nowTimestamp;
                    $sisaHari = (int)ceil($remainingSeconds / (24 * 3600));
                    $activePackageName = $latestTransaction->nama;
                }
            }
        }

        return view('siswa.home', compact('userName', 'userEmail', 'userRole', 'userJenjang', 'photoProfile', 'activities', 'vouchers', 'activePackageName', 'sisaHari'));
    }

    public function daftarMateri(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        $mapel = $request->query('mapel', 'Matematika');
        
        $materis = \Illuminate\Support\Facades\DB::table('materi')
            ->join('user', 'materi.id_guru', '=', 'user.id_user')
            ->where('materi.judul', 'LIKE', '%' . $mapel . '%')
            ->select('materi.*', 'user.nama as nama_guru')
            ->get();
            
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

        if ($jenjangName) {
            $paketList = \Illuminate\Support\Facades\DB::table('paket_pembelajaran')
                ->where('jenjang', $jenjangName)
                ->orWhere('jenjang', 'Umum')
                ->get();
        } else {
            $paketList = \Illuminate\Support\Facades\DB::table('paket_pembelajaran')->get();
        }
        
        // Fetch active vouchers
        $vouchers = \Illuminate\Support\Facades\DB::table('voucher')
            ->where('tanggal_berakhir', '>=', now()->toDateString())
            ->get();

        return view('siswa.paket_belajar', compact('userName', 'photoProfile', 'paketList', 'jenjangName', 'vouchers'));
    }

    public function notifikasi(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        
        $user = $session->getUser();
        $activities = collect();
        if ($user) {
            $activities = \App\Models\Activity::where('user_id', $user->getKey())
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
