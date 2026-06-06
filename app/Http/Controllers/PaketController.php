<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Paket;
use Illuminate\Support\Facades\Auth;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        $userName = Auth::user() ? Auth::user()->nama : 'Admin';
        $photoProfile = Auth::user() ? Auth::user()->photo_profile : null;
        return view('admin.paket.index', compact('pakets', 'userName', 'photoProfile'));
    }

    public function create()
    {
        $userName = Auth::user() ? Auth::user()->nama : 'Admin';
        $photoProfile = Auth::user() ? Auth::user()->photo_profile : null;
        return view('admin.paket.create', compact('userName', 'photoProfile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'masa_aktif' => 'required|integer|min:1',
        ]);

        Paket::create($request->all());

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil dihapus');
    }
}
