<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Jadwal;
use App\Dosen;
use App\MataKuliah;
use App\Kelas;
use App\User;
use Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
      if (Auth::user()->user_level == 'admin') {
        $jadwal = Jadwal::all();
        $dosen = Dosen::all();
        $matkul = MataKuliah::all();
        $kelas = Kelas::all();  
        return view('admin.jadwal.index', compact('jadwal', 'dosen', 'matkul', 'kelas'));
      } else if (Auth::user()->user_level == 'dosen') {
          $jadwal = Jadwal::with('dosen')->where('kode_dosen', Auth::user()->dosen->kode_dosen)->get();
          // dd($jadwal);            
          return view('dosen.jadwal.index', compact('jadwal'));
      } else {
        $jadwal = DB::table('jadwal')
        ->join('matkul', 'jadwal.kode_matkul', '=', 'matkul.kode_matkul')
        ->join('reg_matkul_jadwal', 'jadwal.id', '=', 'reg_matkul_jadwal.id_jadwal')      
        ->join('reg_matkul', 'reg_matkul.id', '=', 'reg_matkul_jadwal.id_reg_matkul')      
        ->where('reg_matkul.semester', $this->getTahunAjar())
        ->where('nim', Auth::user()->mahasiswa->nim)
        ->where('status', 'ok')
        ->get();
        // dd($jadwal);
        return view('mahasiswa.jadwal.index', compact('jadwal'));
      }
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

      return redirect()->route('admin.jadwal.index');
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

      return redirect()->route('admin.jadwal.index');
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
      return redirect()->route('admin.jadwal.index');
    }

    public function getStatusRegistrasi(){
      $config = DB::table('config')->where('config', 'status_reg')->first();
      return $config->value;
    }

    public function getTahunAjar(){
      $config = DB::table('config')->where('config', 'tahun_ajar')->first();
      return $config->value;
    }

    public function getJadwalSementara(){
      if ($this->getStatusRegistrasi() == 'Tidak Aktif') {
        $jadwal = [];
        // return view('mahasiswa.registrasi.jadwal.index', compact('jadwal'));
        return view('mahasiswa.jadwal.sementara', compact('jadwal'));        
      } else {
        $jadwal = DB::table('jadwal')
        ->join('matkul', 'jadwal.kode_matkul', '=', 'matkul.kode_matkul')
        ->join('reg_matkul_jadwal', 'jadwal.id', '=', 'reg_matkul_jadwal.id_jadwal')      
        ->join('reg_matkul', 'reg_matkul.id', '=', 'reg_matkul_jadwal.id_reg_matkul')      
        ->where('reg_matkul.semester', $this->getTahunAjar())
        ->where('nim', Auth::user()->mahasiswa->nim)
        ->where('status', 'simpan')
        ->orWhere('status', 'siap')
        ->get();
        // dd($jadwal);
        return view('mahasiswa.jadwal.sementara', compact('jadwal'));
      }
    }

    public function getDataJadwalDosenSmtIni(){
      $jadwal = Jadwal::with('dosen')->where('kode_dosen', Auth::user()->dosen->kode_dosen)->where('semester',$this->getTahunAjar())->get();
      // dd($jadwal);            
      return view('dosen.nilai.index', compact('jadwal'));
    }
}
