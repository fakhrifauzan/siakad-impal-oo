<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jadwal;
use App\Dosen;
use App\MataKuliah;
use App\Kelas;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $jadwal = Jadwal::all();
      $dosen = Dosen::all();
      $matkul = MataKuliah::all();
      $kelas = Kelas::all();

      return view('admin.jadwal.index', compact('jadwal', 'dosen', 'matkul', 'kelas'));
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
        'kode_dosen' => 'required',
        'kode_matkul' => 'required',
        'kode_kelas' => 'required',
        'semester' => 'required',
        'hari' => 'required',
        'jam' => 'required',
        'ruangan' => 'required',
      ]);

      $jadwal = Jadwal::create([
        'kode_dosen' => $request->kode_dosen,
        'kode_matkul' => $request->kode_matkul,
        'kode_kelas' => $request->kode_kelas,
        'semester' => $request->semester,
        'hari' => $request->hari,
        'jam' => $request->jam,
        'ruangan' => $request->ruangan,
      ]);

      return redirect('/jadwal');
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
      $jadwal = Jadwal::findOrFail($id);
      return $jadwal->toJson();
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
      $jadwal = Jadwal::find($id);
      $jadwal->update([
        'kode_dosen' => $request->kode_dosen,
        'kode_matkul' => $request->kode_matkul,
        'kode_kelas' => $request->kode_kelas,
        'semester' => $request->semester,
        'hari' => $request->hari,
        'jam' => $request->jam,
        'ruangan' => $request->ruangan,
      ]);

      return redirect('/jadwal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Jadwal::destroy($id);
      return redirect('/jadwal');
    }
}
