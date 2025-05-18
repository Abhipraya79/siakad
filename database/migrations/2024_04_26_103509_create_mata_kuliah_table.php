<?php

// database/migrations/2025_04_26_000003_create_mata_kuliah_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id('id_mata_kuliah');
            $table->string('kode_mata_kuliah', 20)->unique();
            $table->string('nama_mata_kuliah', 100);
            $table->integer('sks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mata_kuliah');
    }
};
