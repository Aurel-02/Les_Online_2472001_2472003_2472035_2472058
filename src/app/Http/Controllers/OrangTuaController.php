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
        $students = User::where('role', 'siswa')
            ->orderBy('nama', 'asc')
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
}
