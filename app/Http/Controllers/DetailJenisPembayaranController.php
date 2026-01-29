<?php

namespace App\Http\Controllers;

use App\Models\DetailJenisPembayaran;
use Illuminate\Http\Request;

class DetailJenisPembayaranController extends Controller
{
    public function index()
    {
        return DetailJenisPembayaran::with('jenisPembayaran')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_jenis_pembayaran' => 'required|exists:jenis_pembayarans,id',
            'no_rek'              => 'required|string|max:25',
            'tempat_bayar'        => 'required|string|max:50',
        ]);

        return DetailJenisPembayaran::create($data);
    }

    public function show(DetailJenisPembayaran $detailJenisPembayaran)
    {
        return $detailJenisPembayaran->load('jenisPembayaran');
    }

    public function update(Request $request, DetailJenisPembayaran $detailJenisPembayaran)
    {
        $data = $request->validate([
            'no_rek'       => 'required|string|max:25',
            'tempat_bayar' => 'required|string|max:50',
        ]);

        $detailJenisPembayaran->update($data);
        return $detailJenisPembayaran;
    }

    public function destroy(DetailJenisPembayaran $detailJenisPembayaran)
    {
        $detailJenisPembayaran->delete();
        return response()->json(['message' => 'Detail pembayaran dihapus']);
    }
}
