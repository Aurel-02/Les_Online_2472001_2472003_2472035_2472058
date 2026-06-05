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

        return view('admin.dashboard', compact('userName', 'photoProfile', 'reactivationRequestsCount'));
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
}
