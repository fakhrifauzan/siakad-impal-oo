<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegMatkulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_matkul', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nim')->unisgned();
            $table->string('semester');
            $table->string('status');

            $table->foreign('nim')->references('nim')->on('mahasiswa')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        // Create reg_matkul_jadwal to user pivot table
        Schema::create('reg_matkul_jadwal', function (Blueprint $table) {
            $table->integer('id_reg_matkul')->unsigned();
            $table->integer('id_jadwal')->unsigned();

            $table->foreign('id_reg_matkul')->references('id')->on('reg_matkul')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id')->on('jadwal')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['id_reg_matkul', 'id_jadwal']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reg_matkul_jadwal');
        Schema::dropIfExists('reg_matkul');        
    }
}
