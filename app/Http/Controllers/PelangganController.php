<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    /**
     * Tampilkan semua pelanggan
     */
    public function index()
    {
        return Pelanggan::latest()->get();
    }

    /**
     * Simpan pelanggan baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'email'          => 'required|email|unique:pelanggans,email',
            'password'       => 'required|min:6',
            'tgl_lahir'      => 'required|date',
            'telepon'        => 'required|string|max:15',
            'alamat1'        => 'required|string|max:255',
            'alamat2'        => 'nullable|string|max:255',
            'alamat3'        => 'nullable|string|max:255',
            'kartu_id'       => 'required|string|max:255',
            'foto'           => 'nullable|string|max:255',
        ]);

        // hash password
        $data['password'] = Hash::make($data['password']);

        return Pelanggan::create($data);
    }

    /**
     * Detail pelanggan
     */
    public function show(Pelanggan $pelanggan)
    {
        return $pelanggan->load('pemesanans');
    }

    /**
     * Update pelanggan
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $data = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'email'          => 'required|email|unique:pelanggans,email,' . $pelanggan->id,
            'password'       => 'nullable|min:6',
            'tgl_lahir'      => 'required|date',
            'telepon'        => 'required|string|max:15',
            'alamat1'        => 'required|string|max:255',
            'alamat2'        => 'nullable|string|max:255',
            'alamat3'        => 'nullable|string|max:255',
            'kartu_id'       => 'required|string|max:255',
            'foto'           => 'nullable|string|max:255',
        ]);

        // kalau password diisi → hash ulang
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $pelanggan->update($data);

        return $pelanggan;
    }

    /**
     * Hapus pelanggan
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return response()->json([
            'message' => 'Pelanggan berhasil dihapus'
        ]);
    }
}
