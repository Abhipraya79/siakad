<?php

// database/migrations/2025_04_26_000005_create_frs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('frs', function (Blueprint $table) {
            $table->id('id_frs');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_jadwal_kuliah');
            $table->unsignedBigInteger('id_dosen_wali');
            $table->enum('status_acc', ['pending', 'approved', 'rejected'])->default('pending');
            $table->integer('semester');
            $table->timestamps();

            $table->foreign('id_mahasiswa')
                  ->references('id_mahasiswa')
                  ->on('mahasiswa')
                  ->onDelete('cascade');

            $table->foreign('id_jadwal_kuliah')
                  ->references('id_jadwal_kuliah')
                  ->on('jadwal_kuliah')
                  ->onDelete('cascade');

            $table->foreign('id_dosen_wali')
                  ->references('id_dosen_wali')
                  ->on('dosen_wali')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('frs');
    }
};
