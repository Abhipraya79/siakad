<?php

// database/migrations/2025_04_26_000001_create_mahasiswa_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('id_mahasiswa', 20)->primary();
            $table->string('nama', 100);
            $table->string('nrp', 20)->unique(); // Assuming NFP is NRP/NIM
            $table->string('prodi', 50);
            $table->year('tahun_masuk');
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
};