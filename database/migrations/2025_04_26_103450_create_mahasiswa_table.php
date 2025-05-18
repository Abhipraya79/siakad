<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa'); 
            $table->unsignedBigInteger('id_dosen_wali')->nullable();
            $table->string('nama', 100);
            $table->string('nrp', 20)->unique();
            $table->string('prodi', 50);
            $table->year('tahun_masuk');
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_dosen_wali')->references('id_dosen_wali')->on('dosen_wali')->onDelete('set null');

        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
};
