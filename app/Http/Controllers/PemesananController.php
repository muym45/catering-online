<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * List semua pemesanan
     */
    public function index()
    {
        return Pemesanan::with([
            'pelanggan',
            'jenisPembayaran',
            'details.paket',
            'pengiriman'
        ])->latest()->get();
    }

    /**
     * Simpan pemesanan baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pelanggan'  => 'required|exists:pelanggans,id',
            'id_jenis_bayar'=> 'required|exists:jenis_pembayarans,id',
            'tgl_pesan'     => 'required|date',
            'total_bayar'   => 'required|integer',
        ]);

        // default status sesuai PDM
        $data['status_pesan'] = 'Menunggu Konfirmasi';
        $data['no_resi'] = null;

        return Pemesanan::create($data);
    }

    /**
     * Detail pemesanan
     */
    public function show(Pemesanan $pemesanan)
    {
        return $pemesanan->load([
            'pelanggan',
            'jenisPembayaran',
            'details.paket',
            'pengiriman'
        ]);
    }

    /**
     * Update pemesanan
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $data = $request->validate([
            'status_pesan' => 'required|in:Menunggu Konfirmasi,Sedang Diproses,Menunggu Kurir',
            'no_resi'      => 'nullable|string|max:30',
        ]);

        $pemesanan->update($data);
        return $pemesanan;
    }

    /**
     * Hapus pemesanan
     */
    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();
        return response()->json([
            'message' => 'Pemesanan berhasil dihapus'
        ]);
    }
}
