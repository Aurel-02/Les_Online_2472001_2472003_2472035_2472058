<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserSession;

class AdminController extends Controller
{
    public function dashboard()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = \App\Models\User::withTrashed()->where('reactivation_requested', true)->count();

        $totalSiswa = \App\Models\User::where('role', 'siswa')->count();
        $totalGuru  = \App\Models\User::where('role', 'guru')->count();
        $totalKelas = \App\Models\Materi::whereNotNull('kelas')->where('kelas', '!=', '')->distinct('kelas')->count('kelas');

        return view('admin.dashboard', compact('userName', 'photoProfile', 'reactivationRequestsCount', 'totalSiswa', 'totalGuru', 'totalKelas'));
    }

    public function users()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = \App\Models\User::withTrashed()->where('reactivation_requested', true)->count();

        $users = \App\Models\User::withTrashed()
            ->where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users', compact('userName', 'photoProfile', 'users', 'reactivationRequestsCount'));
    }

    public function destroyUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Prevent deleting oneself
        if ($user->id_user === \Illuminate\Support\Facades\Auth::id()) {
            return redirect()->back()->with('error', 'Tidak dapat menonaktifkan akun sendiri.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dinonaktifkan.');
    }

    public function restoreUser($id)
    {
        $user = \App\Models\User::withTrashed()->findOrFail($id);
        $user->restore();
        
        // Clear reactivation requested flag
        $user->reactivation_requested = false;
        $user->save();

        return redirect()->back()->with('success', 'Pengguna berhasil diaktifkan kembali.');
    }

    public function notifications()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = \App\Models\User::withTrashed()->where('reactivation_requested', true)->count();
        $reactivationRequests = \App\Models\User::withTrashed()
            ->where('reactivation_requested', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.notifications', compact('userName', 'photoProfile', 'reactivationRequestsCount', 'reactivationRequests'));
    }

    public function transactions()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = \App\Models\User::withTrashed()->where('reactivation_requested', true)->count();
        
        // Calculate total income
        $totalIncome = \App\Models\Transaksi::whereIn('status', ['sukses', 'berhasil'])->sum('subtotal');
        
        // Data untuk Grafik (7 hari terakhir)
        $chartDataRaw = \App\Models\Transaksi::where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->whereIn('status', ['sukses', 'berhasil'])
            ->selectRaw('DATE(created_at) as date, SUM(subtotal) as daily_income')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        // Siapkan array untuk 7 hari terakhir agar data yang kosong tetap bernilai 0
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = now()->subDays($i)->translatedFormat('d M');
            $match = $chartDataRaw->firstWhere('date', $date);
            $chartData[] = $match ? $match->daily_income : 0;
        }

        // Get total transactions
        $totalTransactions = \App\Models\Transaksi::count();

        return view('admin.transactions', compact(
            'userName', 'photoProfile', 'reactivationRequestsCount', 
            'totalIncome', 'totalTransactions', 
            'chartLabels', 'chartData'
        ));
    }

    public function promoIndex()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = \App\Models\User::withTrashed()->where('reactivation_requested', true)->count();
        
        $vouchers = \App\Models\Voucher::orderBy('id_voucher', 'desc')->get();

        return view('admin.promo', compact('userName', 'photoProfile', 'reactivationRequestsCount', 'vouchers'));
    }

    public function promoStore(Request $request)
    {
        $request->validate([
            'kode_voucher' => 'required|string|unique:voucher,kode_voucher|max:50',
            'potongan' => 'required|numeric|min:0',
            'tanggal_berakhir' => 'required|date',
        ]);

        \App\Models\Voucher::create([
            'kode_voucher' => strtoupper($request->kode_voucher),
            'potongan' => $request->potongan,
            'tanggal_berakhir' => $request->tanggal_berakhir,
        ]);

        return redirect()->back()->with('success', 'Promo baru berhasil ditambahkan!');
    }

    public function promoDestroy($id)
    {
        $voucher = \App\Models\Voucher::findOrFail($id);
        $voucher->delete();

        return redirect()->back()->with('success', 'Promo berhasil dihapus!');
    }

    public function paketIndex()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = \App\Models\User::withTrashed()->where('reactivation_requested', true)->count();
        
        $pakets = \App\Models\PaketPembelajaran::orderBy('id_paket', 'desc')->get();

        return view('admin.paket', compact('userName', 'photoProfile', 'reactivationRequestsCount', 'pakets'));
    }

    public function paketStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'jenjang' => 'required|in:SD,SMP,SMA,Umum',
            'harga' => 'required|numeric|min:0',
            'masa_aktif' => 'required|integer|min:1',
        ]);

        \App\Models\PaketPembelajaran::create([
            'nama' => $request->nama,
            'jenjang' => $request->jenjang,
            'harga' => $request->harga,
            'masa_aktif' => $request->masa_aktif,
        ]);

        return redirect()->back()->with('success', 'Paket pembelajaran baru berhasil ditambahkan!');
    }

    public function paketUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'jenjang' => 'required|in:SD,SMP,SMA,Umum',
            'harga' => 'required|numeric|min:0',
            'masa_aktif' => 'required|integer|min:1',
        ]);

        $paket = \App\Models\PaketPembelajaran::findOrFail($id);
        $paket->update([
            'nama' => $request->nama,
            'jenjang' => $request->jenjang,
            'harga' => $request->harga,
            'masa_aktif' => $request->masa_aktif,
        ]);

        return redirect()->back()->with('success', 'Paket pembelajaran berhasil diperbarui!');
    }

    public function paketDestroy($id)
    {
        $paket = \App\Models\PaketPembelajaran::findOrFail($id);
        $paket->delete();

        return redirect()->back()->with('success', 'Paket pembelajaran berhasil dihapus!');
    }
}
