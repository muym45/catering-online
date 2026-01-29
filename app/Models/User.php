<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // jika nanti mau cast atau tanggal
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi: user (kurir) punya banyak pengiriman
    public function pengirimans()
    {
        return $this->hasMany(Pengiriman::class, 'id_user');
    }
}
