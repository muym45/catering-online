<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    /**
     * List semua pengiriman
     */
    public function index()
    {
        return Pengiriman::with(['pemesanan', 'user'])->latest()->get();
    }

    /**
     * Simpan data pengiriman
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pesan'     => 'required|exists:pemesanans,id',
            'id_user'      => 'required|exists:users,id',
            'tgl_kirim'    => 'required|date',
            'tgl_tiba'     => 'nullable|date',
            'status_kirim' => 'required|in:Sedang Dikirim,Tiba Ditujuan',
            'bukti_foto'   => 'nullable|string|max:255',
        ]);

        return Pengiriman::create($data);
    }

    /**
     * Detail pengiriman
     */
    public function show(Pengiriman $pengiriman)
    {
        return $pengiriman->load(['pemesanan', 'user']);
    }

    /**
     * Update pengiriman
     */
    public function update(Request $request, Pengiriman $pengiriman)
    {
        $data = $request->validate([
            'tgl_tiba'     => 'nullable|date',
            'status_kirim' => 'required|in:Sedang Dikirim,Tiba Ditujuan',
            'bukti_foto'   => 'nullable|string|max:255',
        ]);

        $pengiriman->update($data);
        return $pengiriman;
    }

    /**
     * Hapus pengiriman
     */
    public function destroy(Pengiriman $pengiriman)
    {
        $pengiriman->delete();

        return response()->json([
            'message' => 'Pengiriman berhasil dihapus'
        ]);
    }
}
