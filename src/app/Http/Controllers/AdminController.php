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
        
        // Calculate total income (assuming 'sukses' status)
        $totalIncome = \App\Models\Transaksi::where('status', 'sukses')->sum('subtotal');
        
        // Get all transactions
        $transactions = \App\Models\Transaksi::with(['user', 'paket', 'voucher'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $totalTransactions = $transactions->count();

        return view('admin.transactions', compact('userName', 'photoProfile', 'reactivationRequestsCount', 'totalIncome', 'totalTransactions', 'transactions'));
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
}
