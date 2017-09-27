<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_dosen');
            $table->string('kode_matkul');
            $table->string('kode_kelas');
            $table->string('hari');
            $table->string('jam');
            $table->string('ruangan');
            $table->string('semester');

            $table->foreign('kode_dosen')->references('kode_dosen')->on('dosen')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kode_matkul')->references('kode_matkul')->on('matkul')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kode_kelas')->references('kode_kelas')->on('kelas')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
}
