<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nim');
            $table->string('semester');
            $table->bigInteger('tagihan');
            $table->string('status');

            $table->foreign('nim')->references('nim')->on('mahasiswa')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('bukti_pembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_registrasi')->unsigned();
            $table->string('tanggal');
            $table->string('bank');
            $table->bigInteger('jumlah');
            $table->string('pemilik_norek');

            $table->foreign('id_registrasi')->references('id')->on('registrasi')
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
        Schema::dropIfExists('bukti_pembayaran');
        Schema::dropIfExists('registrasi');
    }
}
