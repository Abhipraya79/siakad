<?php

// database/migrations/2025_04_26_000002_create_dosen_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id('id_dosen');
            $table->string('nama', 100);
            $table->string('nidn', 20)->unique(); 
            $table->string('bidang_studi', 50);
            $table->string('prodi', 50);
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen');
    }
};