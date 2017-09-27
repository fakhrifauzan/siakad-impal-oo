<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jadwal')->unsigned();
            $table->integer('nim');
            $table->integer('kuis');
            $table->integer('uts');
            $table->integer('uas');
            $table->string('indeks');

            $table->foreign('id_jadwal')->references('id')->on('jadwal')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nim')->references('nim')->on('mahasiswa')
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
        Schema::dropIfExists('nilai');
    }
}
