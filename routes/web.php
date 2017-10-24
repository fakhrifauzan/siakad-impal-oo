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

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
})->name('logout');

//bypass logout

Route::get('/registrasi/matkul', 'RegistrasiController@getDataRegistrasiSmtIni')->name('mahasiswa.registrasi.matkul.index'); 

Route::get('/mahasiswa', 'MahasiswaController@index')->middleware('mahasiswa')->name('mhs');
Route::get('/dosen', 'DosenController@index')->middleware('dosen')->name('dsn');
Route::get('/admin', 'AdminController@index')->middleware('admin')->name('adm');
Route::get('/paycheck', 'AdminController@index')->middleware('admin')->name('pyc');
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

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
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
    Route::get('/registrasi/bukti/{id}/edit', 'RegistrasiController@bukti');
});

Route::group(['prefix' => 'dosen', 'middleware' => 'dosen'], function () {
    Route::get('/home', 'DosenController@index')->name('dosen.home');
    Route::get('/kelas/perwalian/{nim}', 'RegistrasiController@getJadwalSementaraMhs');
    Route::post('/kelas/perwalian/', 'RegistrasiController@accReg')->name('dosen.perwalian.submit');
    Route::get('/nilai', 'JadwalController@getDataJadwalDosenSmtIni')->name('dosen.nilai.index');
    Route::get('/nilai/{id}', 'NilaiController@getDataNilaiMhsKelas');
    Route::post('/nilai', 'NilaiController@setDataNilaiMhsKelas')->name('dosen.nilai.submit');
    Route::resource('jadwal', 'JadwalController', ['names' => [
        'index' => 'dosen.jadwal.index',
    ]]);
    Route::resource('kelas', 'KelasController', ['names' => [
        'index' => 'dosen.kelas.index'
    ]]);
    // Route::resource('nilai', 'NilaiController', ['names' => [
    //     'index' => 'dosen.nilai.index'
    // ]]);
});

Route::group(['prefix' => 'mahasiswa', 'middleware' => 'mahasiswa'], function () {
    Route::get('/home', 'MahasiswaController@index')->name('mahasiswa.home');    
    Route::get('/registrasi/matkul/status', 'RegistrasiController@getStatusAcc');
    Route::post('/registrasi/matkul/submit', 'RegistrasiController@submitReg')->name('mahasiswa.registrasi.matkul.submit');
    Route::get('/registrasi/matkul', 'RegistrasiController@getDataRegistrasiSmtIni')->name('mahasiswa.registrasi.matkul.index'); 
    Route::post('/registrasi/tagihan', 'RegistrasiController@uploadBuktiPembayaran');
    Route::get('/jadwal/sementara', 'JadwalController@getJadwalSementara');
    Route::get('/nilai', 'NilaiController@getDataNilaiMhs')->name('mahasiswa.nilai.index');
    Route::post('/registrasi/matkul/submit', 'RegistrasiController@submitReg')->name('mahasiswa.registrasi.matkul.submit');    
    Route::resource('registrasi', 'RegistrasiController', ['names' => [
        'index' => 'mahasiswa.registrasi.index'
    ]]);
    Route::resource('jadwal', 'JadwalController', ['names' => [
        'index' => 'mahasiswa.jadwal.index',
    ]]);  
});

Route::group(['prefix' => 'paycheck', 'middleware' => 'paycheck'], function () {
    Route::get('/home', 'PaycheckController@index')->name('paycheck.home');
    Route::resource('registrasi', 'RegistrasiController', ['names' => [
        'index' => 'paycheck.registrasi.index'
    ]]);
    Route::get('/registrasi/bukti/{id}/edit', 'RegistrasiController@bukti');
    Route::put('/registrasi/bukti/{id}', 'RegistrasiController@verifikasi_bukti');
});
