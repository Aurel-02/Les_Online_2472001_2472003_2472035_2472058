<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Services\UserSession;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VoucherController extends Controller
{
    // ─── Shared sidebar data helper ─────────────────────────────────────────────
    private function sidebarData(): array
    {
        $session = UserSession::getInstance();
        return [
            'userName'     => $session->getName(),
            'photoProfile' => $session->getPhotoProfile(),
        ];
    }

    // ─── INDEX — daftar semua voucher ───────────────────────────────────────────
    public function index(Request $request)
    {
        $sd = $this->sidebarData();

        $query = Voucher::query();

        // Filter status
        $status = $request->query('status', '');
        if ($status === 'aktif') {
            $query->whereDate('tanggal_berakhir', '>=', now()->toDateString());
        } elseif ($status === 'kedaluwarsa') {
            $query->whereDate('tanggal_berakhir', '<', now()->toDateString());
        }

        // Search by kode
        $search = $request->query('search', '');
        if ($search) {
            $query->where('kode_voucher', 'like', "%{$search}%");
        }

        $vouchers = $query->orderBy('tanggal_berakhir', 'desc')->paginate(15)->withQueryString();

        $counts = [
            'semua'       => Voucher::count(),
            'aktif'       => Voucher::whereDate('tanggal_berakhir', '>=', now()->toDateString())->count(),
            'kedaluwarsa' => Voucher::whereDate('tanggal_berakhir', '<', now()->toDateString())->count(),
        ];

        return view('admin.voucher.index', array_merge($sd, compact('vouchers', 'counts', 'status', 'search')));
    }

    // ─── CREATE — tampilkan form tambah voucher ─────────────────────────────────
    public function create()
    {
        $sd = $this->sidebarData();
        return view('admin.voucher.form', array_merge($sd, ['voucher' => null]));
    }

    // ─── STORE — simpan voucher baru ────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'kode_voucher'     => 'required|string|max:50|unique:voucher,kode_voucher',
            'tipe_potongan'    => 'required|in:persentase,nominal',
            'potongan'         => [
                'required', 'numeric', 'min:0',
                $request->tipe_potongan === 'persentase' ? 'max:100' : 'max:99999999',
            ],
            'tanggal_berakhir' => 'required|date|after_or_equal:today',
        ], [
            'kode_voucher.required'     => 'Kode voucher wajib diisi.',
            'kode_voucher.unique'       => 'Kode voucher sudah digunakan, gunakan kode lain.',
            'kode_voucher.max'          => 'Kode voucher maksimal 50 karakter.',
            'tipe_potongan.required'    => 'Tipe potongan wajib dipilih.',
            'potongan.required'         => 'Nilai potongan wajib diisi.',
            'potongan.numeric'          => 'Nilai potongan harus berupa angka.',
            'potongan.max'              => 'Persentase potongan maksimal 100%.',
            'tanggal_berakhir.required' => 'Tanggal kedaluwarsa wajib diisi.',
            'tanggal_berakhir.after_or_equal' => 'Tanggal kedaluwarsa tidak boleh di masa lalu.',
        ]);

        Voucher::create([
            'kode_voucher'     => strtoupper(trim($request->kode_voucher)),
            'tipe_potongan'    => $request->tipe_potongan,
            'potongan'         => $request->potongan,
            'tanggal_berakhir' => $request->tanggal_berakhir,
        ]);

        return redirect()->route('admin.voucher.index')
            ->with('success', 'Voucher berhasil ditambahkan!');
    }

    // ─── EDIT — tampilkan form edit voucher ────────────────────────────────────
    public function edit($id)
    {
        $sd      = $this->sidebarData();
        $voucher = Voucher::findOrFail($id);
        return view('admin.voucher.form', array_merge($sd, compact('voucher')));
    }

    // ─── UPDATE — simpan perubahan voucher ─────────────────────────────────────
    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        $request->validate([
            'kode_voucher'     => ['required', 'string', 'max:50', Rule::unique('voucher', 'kode_voucher')->ignore($voucher->id_voucher, 'id_voucher')],
            'tipe_potongan'    => 'required|in:persentase,nominal',
            'potongan'         => [
                'required', 'numeric', 'min:0',
                $request->tipe_potongan === 'persentase' ? 'max:100' : 'max:99999999',
            ],
            'tanggal_berakhir' => 'required|date',
        ], [
            'kode_voucher.required'  => 'Kode voucher wajib diisi.',
            'kode_voucher.unique'    => 'Kode voucher sudah digunakan, gunakan kode lain.',
            'tipe_potongan.required' => 'Tipe potongan wajib dipilih.',
            'potongan.required'      => 'Nilai potongan wajib diisi.',
            'potongan.max'           => 'Persentase potongan maksimal 100%.',
            'tanggal_berakhir.required' => 'Tanggal kedaluwarsa wajib diisi.',
        ]);

        $voucher->update([
            'kode_voucher'     => strtoupper(trim($request->kode_voucher)),
            'tipe_potongan'    => $request->tipe_potongan,
            'potongan'         => $request->potongan,
            'tanggal_berakhir' => $request->tanggal_berakhir,
        ]);

        return redirect()->route('admin.voucher.index')
            ->with('success', 'Voucher berhasil diperbarui!');
    }

    // ─── DESTROY — hapus voucher ─────────────────────────────────────────────
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return redirect()->route('admin.voucher.index')
            ->with('success', 'Voucher berhasil dihapus.');
    }
}
