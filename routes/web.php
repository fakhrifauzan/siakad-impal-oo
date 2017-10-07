<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/mahasiswa', 'MahasiswaController@index');
// Route::get('/dosen', 'DosenController@index');
// Route::get('/kelas', 'KelasController@index');
// Route::get('/matkul', 'MataKuliahController@index');
// Route::get('/jadwal', 'JadwalController@index');

Route::resource('mahasiswa', 'MahasiswaController');
Route::resource('dosen', 'DosenController');
Route::resource('kelas', 'KelasController');
Route::resource('matkul', 'MataKuliahController');
Route::resource('jadwal', 'JadwalController');
Route::resource('registrasi', 'RegistrasiController');
Route::post('/registrasi/updateConfig', 'RegistrasiController@setKonfigurasiRegistrasi');

Route::prefix('admin')->group(function () {
    // Route::resource('mahasiswa', 'MahasiswaController');
    // Route::resource('dosen', 'DosenController');
    // Route::resource('kelas', 'KelasController');
    // Route::resource('matkul', 'MataKuliahController');
    // Route::resource('jadwal', 'JadwalController');
    // Route::resource('registrasi', 'RegistrasiController');
});
