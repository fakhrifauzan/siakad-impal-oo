<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getStatusRegistrasi(){
        $config = DB::table('config')->where('config', 'status_reg')->first();
        return $config->value;
    }

    public function getDataNilaiMhsKelas($id) {
        $statusReg = $this->getStatusRegistrasi();
        $nilai = DB::table('mahasiswa')
        ->join('users', 'users.id', '=', 'mahasiswa.user_id')
        ->join('reg_matkul', 'mahasiswa.nim', '=', 'reg_matkul.nim')
        ->join('reg_matkul_jadwal', 'reg_matkul.id', '=', 'reg_matkul_jadwal.id_reg_matkul')      
        ->leftJoin('nilai', 'nilai.id_jadwal', '=', 'reg_matkul_jadwal.id_jadwal')      
        // ->where('nilai.id_jadwal', $id)
        ->where('reg_matkul_jadwal.id_jadwal', $id)
        ->where('reg_matkul.status', 'ok')
        ->select('mahasiswa.nim', 'mahasiswa.kode_kelas as kelas', 'users.name as nama', 'nilai.kuis', 'nilai.uts', 'nilai.uas', 'nilai.indeks')
        ->get();
        // dd($nilai);
        return view('dosen.nilai.show', compact('nilai', 'statusReg', 'id'));
    }

    public function setDataNilaiMhsKelas(Request $request) {
        // dd($request);
        $cek = DB::table('nilai')->where('id_jadwal', $request->id_jadwal)->get();
        if ($cek != null){
            DB::table('nilai')->where('id_jadwal', '=', $request->id_jadwal)->delete();
        }
        $i = 0;
        if ($request->nim != null) {
            foreach ($request->nim as $nim) {
            $rata = ($request->kuis[$i] + $request->uts[$i] + $request->uas[$i])/3;
            DB::table('nilai')->insert([
                'id_jadwal' => $request->id_jadwal,
                'nim' => $nim,
                'kuis' => $request->kuis[$i],
                'uts' => $request->uts[$i],
                'uas' => $request->uas[$i],
                'indeks' => $this->gradingNilai($rata),
            ]);
            $i++;
            }
        }
        return redirect('/dosen/nilai/' . $request->id_jadwal);
    }

    public function gradingNilai($rata) {
        if ($rata > 80) {
            return 'A';
        } else if ($rata > 70 and $rata <= 80) {
            return 'AB';
        } else if ($rata > 65 and $rata <= 70) {
            return 'B';
        } else if ($rata > 60 and $rata <= 65) {
            return 'BC';
        } else if ($rata > 50 and $rata <= 60) {
            return 'C';
        } else if ($rata > 40 and $rata <= 50) {
            return 'D';
        } else {
            return 'E';
        }
    }

    public function getDataNilaiMhs() {
        $nim = Auth::user()->mahasiswa->nim;
        $nilai = DB::table('mahasiswa')
        ->join('users', 'users.id', '=', 'mahasiswa.user_id')
        ->join('reg_matkul', 'mahasiswa.nim', '=', 'reg_matkul.nim')
        ->join('reg_matkul_jadwal', 'reg_matkul.id', '=', 'reg_matkul_jadwal.id_reg_matkul')
        ->join('jadwal', 'jadwal.id', '=', 'reg_matkul_jadwal.id_reg_matkul')
        ->join('matkul', 'matkul.kode_matkul', '=', 'jadwal.kode_matkul')         
        ->leftJoin('nilai', 'nilai.id_jadwal', '=', 'reg_matkul_jadwal.id_jadwal')
        ->where('mahasiswa.nim', $nim)
        ->where('reg_matkul.status', 'ok')
        // ->whereIn('reg_matkul_jadwal.id_jadwal', function (){
        //     DB::table('nilai')->select('id_jadwal')->get();
        // })
        ->select('matkul.kode_matkul', 'matkul.nama_matkul', 'matkul.sks', 'jadwal.semester as semester', 'nilai.kuis', 'nilai.uts', 'nilai.uas', 'nilai.indeks')
        ->get();
        // dd($nilai);
        return view('mahasiswa.nilai.index', compact('nilai'));
    }

    
}
