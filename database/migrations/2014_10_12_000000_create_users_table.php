<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('nim')->unique();
            // $table->string('kode_dosen')->unique();
            $table->string('name');
            $table->string('fakultas');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_level');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen');
        Schema::dropIfExists('mahasiswa');
        Schema::dropIfExists('users');        
    }
}
