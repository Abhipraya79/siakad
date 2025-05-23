    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('jadwal_kuliah', function (Blueprint $table) {
                $table->id('id_jadwal_kuliah');
                $table->unsignedBigInteger('id_mata_kuliah');
                $table->unsignedBigInteger('id_dosen');
                $table->unsignedBigInteger('id_ruang');
                $table->string('kelas', 10);
                $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
                $table->time('jam_mulai');
                $table->time('jam_selesai');
                $table->timestamps();

                $table->foreign('id_mata_kuliah')->references('id_mata_kuliah')->on('mata_kuliah')->onDelete('cascade');
                $table->foreign('id_dosen')->references('id_dosen')->on('dosen')->onDelete('cascade');
                $table->foreign('id_ruang')->references('id_ruang')->on('ruangan')->onDelete('cascade');
            });
        }

        public function down()
        {
            Schema::dropIfExists('jadwal_kuliah');
        }
    };
