<?php

// database/migrations/2025_04_26_000007_create_ruangan_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ruangan', function (Blueprint $table) {
            $table->string('id_ruang', 20)->primary();
            $table->string('kode_ruang', 20)->unique();
            $table->string('nama_ruang', 100);
            $table->integer('kapasitas_ruang');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ruangan');
    }
};
