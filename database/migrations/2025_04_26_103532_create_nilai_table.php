<?php

// database/migrations/2025_04_26_000006_create_nilai_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->string('id_nilai', 20)->primary();
            $table->string('id_frs', 20);
            $table->integer('nilai_angka')->nullable();
            $table->string('nilai_huruf', 2)->nullable();
            $table->timestamps();

            $table->foreign('id_frs')
                  ->references('id_frs')
                  ->on('frs')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai');
    }
};