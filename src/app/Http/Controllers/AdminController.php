<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserSession;
use App\Pattern\DAO\UserDAO;
use App\Pattern\DAO\TransaksiDAO;
use App\Pattern\DAO\MateriDAO;
use App\Pattern\DAO\VoucherDAO;
use App\Pattern\DAO\PaketPembelajaranDAO;
use App\Pattern\DAO\PengumumanDAO;

class AdminController extends Controller
{
    protected $userDAO;
    protected $transaksiDAO;
    protected $materiDAO;
    protected $voucherDAO;
    protected $paketDAO;
    protected $pengumumanDAO;

    public function __construct(
        UserDAO $userDAO,
        TransaksiDAO $transaksiDAO,
        MateriDAO $materiDAO,
        VoucherDAO $voucherDAO,
        PaketPembelajaranDAO $paketDAO,
        PengumumanDAO $pengumumanDAO
    ) {
        $this->userDAO = $userDAO;
        $this->transaksiDAO = $transaksiDAO;
        $this->materiDAO = $materiDAO;
        $this->voucherDAO = $voucherDAO;
        $this->paketDAO = $paketDAO;
        $this->pengumumanDAO = $pengumumanDAO;
    }

    public function dashboard()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = $this->userDAO->getReactivationRequestsCount();
        $totalSiswa = $this->userDAO->getTotalSiswa();
        $totalGuru  = $this->userDAO->getTotalGuru();
        $totalKelas = $this->materiDAO->getTotalKelas();

        return view('admin.dashboard', compact('userName', 'photoProfile', 'reactivationRequestsCount', 'totalSiswa', 'totalGuru', 'totalKelas'));
    }

    public function users()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = $this->userDAO->getReactivationRequestsCount();
        $users = $this->userDAO->getUsersExcludingAdmin();

        return view('admin.users', compact('userName', 'photoProfile', 'users', 'reactivationRequestsCount'));
    }

    public function destroyUser($id)
    {
        // Prevent deleting oneself
        if ((int)$id === \Illuminate\Support\Facades\Auth::id()) {
            return redirect()->back()->with('error', 'Tidak dapat menonaktifkan akun sendiri.');
        }

        $this->userDAO->softDeleteUser($id);

        return redirect()->back()->with('success', 'Pengguna berhasil dinonaktifkan.');
    }

    public function restoreUser($id)
    {
        $this->userDAO->restoreUser($id);
        return redirect()->back()->with('success', 'Pengguna berhasil diaktifkan kembali.');
    }

    public function notifications()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = $this->userDAO->getReactivationRequestsCount();
        $reactivationRequests = $this->userDAO->getReactivationRequests();

        return view('admin.notifications', compact('userName', 'photoProfile', 'reactivationRequestsCount', 'reactivationRequests'));
    }

    public function transactions()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = $this->userDAO->getReactivationRequestsCount();
        $totalIncome = $this->transaksiDAO->getTotalIncome();
        $totalTransactions = $this->transaksiDAO->getTotalTransactions();
        
        $reportData = $this->transaksiDAO->getIncomeChartData(new \App\Pattern\Strategy\WeeklyIncomeStrategy());
        $chartLabels = $reportData['labels'];
        $chartData = $reportData['data'];

        $transactions = $this->transaksiDAO->getAllTransactionsWithDetails();

        return view('admin.transactions', compact(
            'userName', 'photoProfile', 'reactivationRequestsCount', 
            'totalIncome', 'totalTransactions', 
            'chartLabels', 'chartData', 'transactions'
        ));
    }

    public function promoIndex()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = $this->userDAO->getReactivationRequestsCount();
        $vouchers = $this->voucherDAO->getAllVouchers();

        return view('admin.promo', compact('userName', 'photoProfile', 'reactivationRequestsCount', 'vouchers'));
    }

    public function promoStore(Request $request)
    {
        $request->validate([
            'kode_voucher' => 'required|string|unique:voucher,kode_voucher|max:50',
            'potongan' => 'required|numeric|min:0',
            'tanggal_berakhir' => 'required|date',
        ]);

        $this->voucherDAO->createVoucher([
            'kode_voucher' => strtoupper($request->kode_voucher),
            'potongan' => $request->potongan,
            'tanggal_berakhir' => $request->tanggal_berakhir,
        ]);

        return redirect()->back()->with('success', 'Promo baru berhasil ditambahkan!');
    }

    public function promoDestroy($id)
    {
        $this->voucherDAO->deleteVoucher($id);
        return redirect()->back()->with('success', 'Promo berhasil dihapus!');
    }

    public function paketIndex()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = $this->userDAO->getReactivationRequestsCount();
        $pakets = $this->paketDAO->getAllPakets();

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

        $this->paketDAO->createPaket([
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

        $this->paketDAO->updatePaket($id, [
            'nama' => $request->nama,
            'jenjang' => $request->jenjang,
            'harga' => $request->harga,
            'masa_aktif' => $request->masa_aktif,
        ]);

        return redirect()->back()->with('success', 'Paket pembelajaran berhasil diperbarui!');
    }

    public function paketDestroy($id)
    {
        $this->paketDAO->deletePaket($id);
        return redirect()->back()->with('success', 'Paket pembelajaran berhasil dihapus!');
    }

    // ─── PENGUMUMAN ─────────────────────────────────────────────────────────

    public function pengumumanIndex()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = $this->userDAO->getReactivationRequestsCount();
        $pengumumanList = $this->pengumumanDAO->getAllPengumuman();

        return view('admin.pengumuman', compact('userName', 'photoProfile', 'reactivationRequestsCount', 'pengumumanList'));
    }

    public function pengumumanStore(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'isi'    => 'required|string',
            'tipe'   => 'required|in:info,maintenance,warning',
            'target' => 'required|in:semua,guru,siswa,orang_tua',
        ]);

        $this->pengumumanDAO->createPengumuman([
            'judul'  => $request->judul,
            'isi'    => $request->isi,
            'tipe'   => $request->tipe,
            'target' => $request->target,
        ]);

        return redirect()->back()->with('success', 'Pengumuman berhasil dibuat!');
    }

    public function pengumumanToggle($id)
    {
        $this->pengumumanDAO->toggleAktif($id);
        return redirect()->back()->with('success', 'Status pengumuman berhasil diubah!');
    }

    public function pengumumanDestroy($id)
    {
        $this->pengumumanDAO->deletePengumuman($id);
        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus!');
    }
}
