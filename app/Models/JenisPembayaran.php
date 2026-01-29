<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisPembayaran extends Model
{
    //
    use HasFactory;

    protected $table = 'jenis_pembayaran';

    protected $fillable = [
        'metode_pembayaran',
    ];

    public function detailJenis(){
        return $this->hasMany(DetailJenisPembayaran::class, 'id_jenis_pembayaran');
    }

    public function pemesanans(){
        return $this->hasMany(Pemesanan::class, 'id_jenis_bayar');
    }
}
