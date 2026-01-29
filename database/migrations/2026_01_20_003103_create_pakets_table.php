<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket',50);
            $table->enum('jenis',['Prasmanan','Box']);
            $table->enum('Kategori',['Pernikahan','Selamatan','Ulang Tahun','Studi Tour','Rapat']);
            $table->integer('jumlah_pax');
            $table->integer('harga_paket');
            $table->text('deskripsi');
            $table->string('foto1')->nullable();
            $table->string('foto2')->nullable();
            $table->string('foto3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
