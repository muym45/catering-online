<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class DetailPemesananController extends Controller
{
    /**
     * List semua detail pemesanan
     */
    public function index()
    {
        return DetailPemesanan::with(['pemesanan', 'paket'])->get();
    }

    /**
     * Simpan detail pemesanan (item paket)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pemesanan' => 'required|exists:pemesanans,id',
            'id_paket'     => 'required|exists:pakets,id',
            'subtotal'     => 'required|integer',
        ]);

        $detail = DetailPemesanan::create($data);

        // OPTIONAL tapi direkomendasikan:
        // update total_bayar di tabel pemesanans
        $pemesanan = Pemesanan::find($data['id_pemesanan']);
        $pemesanan->increment('total_bayar', $data['subtotal']);

        return $detail;
    }

    /**
     * Detail satu item pemesanan
     */
    public function show(DetailPemesanan $detailPemesanan)
    {
        return $detailPemesanan->load(['pemesanan', 'paket']);
    }

    /**
     * Update detail pemesanan
     */
    public function update(Request $request, DetailPemesanan $detailPemesanan)
    {
        $data = $request->validate([
            'subtotal' => 'required|integer',
        ]);

        // sesuaikan total pemesanan
        $selisih = $data['subtotal'] - $detailPemesanan->subtotal;

        $detailPemesanan->update($data);

        $detailPemesanan->pemesanan->increment('total_bayar', $selisih);

        return $detailPemesanan;
    }

    /**
     * Hapus detail pemesanan
     */
    public function destroy(DetailPemesanan $detailPemesanan)
    {
        // kurangi total bayar
        $detailPemesanan->pemesanan
            ->decrement('total_bayar', $detailPemesanan->subtotal);

        $detailPemesanan->delete();

        return response()->json([
            'message' => 'Detail pemesanan dihapus'
        ]);
    }
}
