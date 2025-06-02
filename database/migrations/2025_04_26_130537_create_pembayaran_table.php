<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_bayar');
            $table->string('token', 10);
            $table->string('kode_bayar', 10);
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_frs');
            $table->date('tanggal_bayar')->default(now());
            $table->enum('status_pembayaran', ['Lunas', 'Belum Lunas']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_frs')->references('id_frs')->on('frs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
