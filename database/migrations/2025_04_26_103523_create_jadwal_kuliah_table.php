<?php

// database/migrations/2025_04_26_000004_create_jadwal_kuliah_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('jadwal_kuliah', function (Blueprint $table) {
            $table->string('id_jadwal_kuliah', 20)->primary();
            $table->string('id_mata_kuliah', 20);
            $table->string('id_dosen', 20);
            $table->string('id_ruang', 20);
            $table->string('kelas', 10);
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();

            $table->foreign('id_mata_kuliah')
                  ->references('id_mata_kuliah')
                  ->on('mata_kuliah')
                  ->onDelete('cascade');

            $table->foreign('id_dosen')
                  ->references('id_dosen')
                  ->on('dosen')
                  ->onDelete('cascade');

            $table->foreign('id_ruang')
                  ->references('id_ruang')
                  ->on('ruangan')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_kuliah');
    }
};
