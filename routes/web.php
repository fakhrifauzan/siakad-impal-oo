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



// Route::get('/mahasiswa', 'MahasiswaController@index');
// Route::get('/dosen', 'DosenController@index');
// Route::get('/kelas', 'KelasController@index');
// Route::get('/matkul', 'MataKuliahController@index');
// Route::get('/jadwal', 'JadwalController@index');

// Route::resource('mahasiswa', 'MahasiswaController');
// Route::resource('dosen', 'DosenController');
// Route::resource('kelas', 'KelasController');
// Route::resource('matkul', 'MataKuliahController');
// Route::resource('jadwal', 'JadwalController');
// Route::resource('registrasi', 'RegistrasiController');
// Route::post('/registrasi/updateConfig', 'RegistrasiController@setKonfigurasiRegistrasi');

Route::prefix('admin')->group(function () {
    Route::get('/home', 'AdminController@index')->name('admin.home');
    Route::resource('mahasiswa', 'MahasiswaController', ['names' => [
        'index' => 'admin.mahasiswa.index'      
    ]]);
    Route::resource('dosen', 'DosenController', ['names' => [
        'index' => 'admin.dosen.index'      
    ]]);
    Route::resource('kelas', 'KelasController', ['names' => [
        'index' => 'admin.kelas.index'      
    ]]);
    Route::resource('matkul', 'MataKuliahController', ['names' => [
        'index' => 'admin.matkul.index'      
    ]]);
    Route::resource('jadwal', 'JadwalController', ['names' => [
        'index' => 'admin.jadwal.index',
        'store' => 'admin.jadwal.store',          
        'edit' => 'admin.jadwal.edit',          
        'update' => 'admin.jadwal.update'          
    ]]);
    Route::resource('registrasi', 'RegistrasiController', ['names' => [
        'index' => 'admin.registrasi.index'   
    ]]);
    Route::post('/registrasi/updateConfig', 'RegistrasiController@setKonfigurasiRegistrasi');
});

Route::group(['prefix' => 'dosen', 'middleware' => 'guest'], function () {
    Route::get('/home', 'DosenController@index')->name('dosen.home');
});

Route::group(['prefix' => 'mahasiswa', 'middleware' => 'guest'], function () {
    // Route::get('/home', 'HomeController@index')->name('mahasiswa.home');
});
