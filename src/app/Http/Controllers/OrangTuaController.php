<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ExamScore;
use App\Services\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrangTuaController extends Controller
{
    public function index(Request $request)
    {
        $session = UserSession::getInstance();
        $parentUser = $session->getUser();
        $parentName = $session->getName();
        $parentPhoto = $session->getPhotoProfile();
        $students = User::select('user.*')
            ->join('ortu_siswa', 'user.id_user', '=', 'ortu_siswa.id_siswa')
            ->where('ortu_siswa.id_orangtua', $parentUser->id_user)
            ->where('user.role', 'siswa')
            ->orderBy('user.nama', 'asc')
            ->get();

        $selectedStudentId = $request->query('siswa_id');
        $selectedStudent = null;

        if ($selectedStudentId) {
            $selectedStudent = User::where('role', 'siswa')
                ->where('id_user', $selectedStudentId)
                ->first();
        }

        if (!$selectedStudent && $students->count() > 0) {
            $selectedStudent = $students->first();
        }

        $histories = collect();
        $activePackageName = null;
        $sisaHari = 0;
        $jenjangName = 'SMA';

        if ($selectedStudent) {
            $histories = ExamScore::where('user_id', $selectedStudent->getKey())
                ->orderBy('created_at', 'desc')
                ->take(15)
                ->get();

            $jenjangId = $selectedStudent->id_jenjang ?? 3;
            $jenjangName = match ((int)$jenjangId) {
                1 => 'SD',
                2 => 'SMP',
                3 => 'SMA',
                default => 'SMA',
            };

            $latestTransaction = DB::table('transaksi')
                ->join('paket_pembelajaran', 'transaksi.id_paket', '=', 'paket_pembelajaran.id_paket')
                ->where('transaksi.id_user', $selectedStudent->id_user)
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

        $vouchers = DB::table('voucher')
            ->where('tanggal_berakhir', '>=', now()->toDateString())
            ->get();

        $promotedPackages = DB::table('paket_pembelajaran')
            ->where('jenjang', $jenjangName)
<<<<<<< HEAD
=======
            ->orWhere('jenjang', 'Umum')
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
            ->take(3)
            ->get();

        if ($promotedPackages->isEmpty()) {
            $promotedPackages = DB::table('paket_pembelajaran')->take(3)->get();
        }

        return view('orangtua.dashboard', compact(
            'parentName',
            'parentPhoto',
            'students',
            'selectedStudent',
            'histories',
            'activePackageName',
            'sisaHari',
            'jenjangName',
            'vouchers',
            'promotedPackages'
        ));
    }
    public function paketBelajar(Request $request)
    {
        $session = UserSession::getInstance();
        $parentName = $session->getName();
        $parentPhoto = $session->getPhotoProfile();
        $parentUser = $session->getUser();
        
        $students = User::select('user.*')
            ->join('ortu_siswa', 'user.id_user', '=', 'ortu_siswa.id_siswa')
            ->where('ortu_siswa.id_orangtua', $parentUser->id_user)
            ->where('user.role', 'siswa')
            ->orderBy('user.nama', 'asc')
            ->get();

        $selectedStudentId = $request->query('siswa_id');
        $selectedStudent = null;

        if ($selectedStudentId) {
            $selectedStudent = User::where('role', 'siswa')
                ->where('id_user', $selectedStudentId)
                ->first();
        }

        if (!$selectedStudent && $students->count() > 0) {
            $selectedStudent = $students->first();
        }

        $jenjangName = null;
        if ($selectedStudent) {
            $idJenjang = $selectedStudent->id_jenjang ?? 3;
            $jenjangName = match ((int)$idJenjang) {
                1 => 'SD',
                2 => 'SMP',
                3 => 'SMA',
                default => 'SMA',
            };
        }

        if ($jenjangName) {
<<<<<<< HEAD
            $paketList = DB::table('paket_pembelajaran')->where('jenjang', $jenjangName)->get();
=======
            $paketList = DB::table('paket_pembelajaran')
                ->where('jenjang', $jenjangName)
                ->orWhere('jenjang', 'Umum')
                ->get();
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
        } else {
            $paketList = DB::table('paket_pembelajaran')->get();
        }
        
        $vouchers = DB::table('voucher')
            ->where('tanggal_berakhir', '>=', now()->toDateString())
            ->get();

        return view('orangtua.paket_belajar', compact('parentName', 'parentPhoto', 'students', 'selectedStudent', 'paketList', 'jenjangName', 'vouchers'));
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
            'siswa_id' => 'required|integer',
        ]);

        $siswaId = (int)$request->siswa_id;

        // Verify that the requested siswa exists
        $siswaExists = User::where('id_user', $siswaId)->where('role', 'siswa')->exists();
        if (!$siswaExists) {
            return response()->json(['success' => false, 'message' => 'Siswa tidak ditemukan.'], 400);
        }

        // Instantiate Chain of Responsibility Context with the chosen student's ID
        $context = new \App\Services\Checkout\CheckoutContext(
            $siswaId,
            (int)$request->id_paket,
            $request->id_voucher ? (int)$request->id_voucher : null,
            $request->metode_pembayaran
        );

        $packageValidation = new \App\Services\Checkout\PackageValidationHandler();
        $voucherValidation = new \App\Services\Checkout\VoucherValidationHandler();
        $paymentValidation = new \App\Services\Checkout\PaymentMethodValidationHandler();
        $transactionStorage = new \App\Services\Checkout\TransactionStorageHandler();

        $packageValidation
            ->setNext($voucherValidation)
            ->setNext($paymentValidation)
            ->setNext($transactionStorage);

        $packageValidation->handle($context);

        if (!$context->isSuccess) {
            return response()->json([
                'success' => false,
                'message' => $context->errorMessage ?? 'Terjadi kesalahan saat memproses transaksi.'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pembelian paket belajar untuk anak Anda berhasil!',
            'subtotal' => $context->subtotal
        ]);
    }
}
