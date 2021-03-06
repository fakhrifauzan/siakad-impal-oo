<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Registrasi;
use App\Mahasiswa;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $registrasi = Registrasi::all();
      $mahasiswa = Mahasiswa::all();
      $statusReg = $this->getStatusRegistrasi();
      $tahunAjar = $this->getTahunAjar();

      return view('admin.registrasi.index', compact('registrasi', 'mahasiswa', 'statusReg', 'tahunAjar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request);
      $request->validate([
        'nim' => 'required',
        'semester' => 'required',
        'tagihan' => 'required',
        'status' => 'required',
      ]);

      $registrasi = Registrasi::create([
        'nim' => $request->nim,
        'semester' => $request->semester,
        'tagihan' => $request->tagihan,
        'status' => $request->status,
      ]);

      return redirect('/registrasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // Retrieve a model by its primary key...
      // $jadwal = Jadwal::with('users')->where('id', '=', $id)->firstOrFail();
      $registrasi = Registrasi::findOrFail($id);
      return $registrasi->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $registrasi = Registrasi::find($id);
      $registrasi->update([
        'nim' => $request->nim,
        'semester' => $request->semester,
        'tagihan' => $request->tagihan,
        'status' => $request->status,
      ]);

      return redirect('/registrasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Registrasi::destroy($id);
      return redirect('/registrasi');
    }

    public function getStatusRegistrasi(){
      $config = DB::table('config')->where('config', 'status_reg')->first();
      return $config->value;
    }

    public function getTahunAjar(){
      $config = DB::table('config')->where('config', 'tahun_ajar')->first();
      return $config->value;
    }

    public function setKonfigurasiRegistrasi(Request $request){
      // dd($request);
      $request->validate([
        'status' => 'required',
        'tahun_ajar' => 'required',
      ]);

      DB::table('config')->where('config', 'status_reg')
            ->update(['value' => $request->status]);
      DB::table('config')->where('config', 'tahun_ajar')
            ->update(['value' => $request->tahun_ajar]);

      return redirect('/registrasi');
    }
}
