<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        return Paket::latest()->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_paket'   => 'required|string|max:50',
            'jenis'        => 'required|in:Prasmanan,Box',
            'kategori'     => 'required|in:Pernikahan,Selamatan,Ulang Tahun,Studi Tour,Rapat',
            'jumlah_pax'   => 'required|integer',
            'harga_paket'  => 'required|integer',
            'deskripsi'    => 'required',
        ]);

        return Paket::create($data);
    }

    public function show(Paket $paket)
    {
        return $paket;
    }

    public function update(Request $request, Paket $paket)
    {
        $data = $request->validate([
            'nama_paket'   => 'required|string|max:50',
            'jenis'        => 'required|in:Prasmanan,Box',
            'kategori'     => 'required|in:Pernikahan,Selamatan,Ulang Tahun,Studi Tour,Rapat',
            'jumlah_pax'   => 'required|integer',
            'harga_paket'  => 'required|integer',
            'deskripsi'    => 'required',
        ]);

        $paket->update($data);
        return $paket;
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return response()->json(['message' => 'Paket dihapus']);
    }
}
