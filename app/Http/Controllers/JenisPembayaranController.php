<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use Illuminate\Http\Request;

class JenisPembayaranController extends Controller
{
    public function index()
    {
        return JenisPembayaran::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'metode_pembayaran' => 'required|string|max:30',
        ]);

        return JenisPembayaran::create($data);
    }

    public function show(JenisPembayaran $jenisPembayaran)
    {
        return $jenisPembayaran->load('detailJenis');
    }

    public function update(Request $request, JenisPembayaran $jenisPembayaran)
    {
        $data = $request->validate([
            'metode_pembayaran' => 'required|string|max:30',
        ]);

        $jenisPembayaran->update($data);
        return $jenisPembayaran;
    }

    public function destroy(JenisPembayaran $jenisPembayaran)
    {
        $jenisPembayaran->delete();
        return response()->json(['message' => 'Metode pembayaran dihapus']);
    }
}
