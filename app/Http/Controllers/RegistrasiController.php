<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Registrasi;
use App\Mahasiswa;
use Auth;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (Auth::user()->user_level == 'mahasiswa') {
        $registrasi = Registrasi::where('nim', Auth::user()->mahasiswa->nim)->get();
        return view('mahasiswa.registrasi.index', compact('registrasi'));
      } else {
        $registrasi = Registrasi::all();
        $mahasiswa = Mahasiswa::with('user')->get();
        $statusReg = $this->getStatusRegistrasi();
        $tahunAjar = $this->getTahunAjar();
  
        if (Auth::user()->user_level == 'admin') {
          return view('admin.registrasi.index', compact('registrasi', 'mahasiswa', 'statusReg', 'tahunAjar'));
        } else {
          // dd($registrasi);
          return view('paycheck.registrasi.index', compact('registrasi', 'mahasiswa', 'statusReg', 'tahunAjar'));
        }
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

      return redirect('/admin/registrasi');
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

      return redirect('/admin/registrasi');
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
      return redirect('/admin/registrasi');
    }

    public function get_tagihan($id)
    {
      $tagihan = Registrasi::where('id', $id)->get();
      // dd($bukti);
      return $tagihan->toJson();
    }

    public function uploadBuktiPembayaran(Request $request){
      // dd($request);
      $request->validate([
        'id_registrasi' => 'required',
        'tgl_transfer' => 'required',
        'bank' => 'required',
        'jumlah' => 'required',
        'pemilik_rek' => 'required',
      ]);      

      DB::table('bukti_pembayaran')->insert([
          'id_registrasi' => $request->id_registrasi,
          'tanggal' => $request->tgl_transfer,
          'bank' => $request->bank,
          'jumlah' => $request->jumlah,
          'pemilik_norek' => $request->pemilik_rek,
      ]);

      return redirect('/mahasiswa/registrasi');
    }

    public function bukti($id)
    {
      $bukti = DB::table('registrasi')
              ->join('bukti_pembayaran', 'registrasi.id', '=', 'bukti_pembayaran.id_registrasi')
              ->where('bukti_pembayaran.id_registrasi', $id)
              ->orderBy('bukti_pembayaran.id', 'desc')
              ->get();
      // dd($bukti);
      return $bukti->toJson();
    }

    public function verifikasi_bukti(Request $request)
    {
      $registrasi = Registrasi::find($request->id_registrasi);
      $registrasi->update([
        'status' => 'Lunas',
      ]);

      return redirect('/paycheck/registrasi');
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

      return redirect('/admin/registrasi');
    }

    public function getDataRegistrasiSmtIni() {
      $status = $this->getStatusAcc();
      $stat_reg = $this->getStatusRegistrasi();
      if ($stat_reg == 'Tidak Aktif') {
        $matkul = [];        
        $pilihan = [];        
      } else {
        $matkul = DB::table('jadwal')
                ->join('matkul', 'matkul.kode_matkul', '=', 'jadwal.kode_matkul')
                ->where('semester', $this->getTahunAjar())
                ->where('fakultas', Auth::user()->fakultas)
                ->get();
        $pilihan = DB::table('reg_matkul')
                ->join('reg_matkul_jadwal', 'reg_matkul.id', '=', 'reg_matkul_jadwal.id_reg_matkul')
                ->where('semester', $this->getTahunAjar())
                ->where('nim', Auth::user()->mahasiswa->nim)
                ->get();
      }
      // dd($pilihan);
      return view('mahasiswa.registrasi.matkul.index', compact('matkul', 'status', 'pilihan', 'stat_reg'));
    }

    public function submitReg(Request $request) {
      // dd($request);
      if ($request->siapAcc == 'siapAcc') {
        $this->setSiapAcc($request);
      } else if ($request->simpan == 'simpan') {
        $this->simpanKrs($request);
      }     
      return redirect('/mahasiswa/registrasi/matkul');
    }

    public function simpanKrs(Request $request) {
      // dd($request);
      $nim = Auth::user()->mahasiswa->nim;
      $semester = $this->getTahunAjar();
      $cek = DB::table('reg_matkul')->where('nim', $nim)->where('semester', $semester)->first();
      if ($cek != null){
        $id = $cek->id;  
        DB::table('reg_matkul_jadwal')->where('id_reg_matkul', '=', $id)->delete();
      } else {
        $id = DB::table('reg_matkul')->insertGetId([
                'nim' => $nim,
                'semester' => $semester,
                'status' => 'simpan',          
              ]);
      }
      if ($request->jadwal != null) {
        foreach ($request->jadwal as $jadwal) {
          DB::table('reg_matkul_jadwal')->insert([
            'id_reg_matkul' => $id,
            'id_jadwal' => $jadwal,
          ]);
        }
      }
    }

    public function setSiapAcc(Request $request) {
      $nim = Auth::user()->mahasiswa->nim;
      $semester = $this->getTahunAjar();
      DB::table('reg_matkul')
      ->where('nim', $nim)
      ->where('semester', $semester)
      ->update([
        'status' => 'siap',
      ]);
    }

    public function getStatusAcc() {
      $nim = Auth::user()->mahasiswa->nim;
      $semester = $this->getTahunAjar();
      $cek = DB::table('reg_matkul')
              ->where('nim', Auth::user()->mahasiswa->nim)
              ->where('semester', $this->getTahunAjar())
              ->value('status');
      // dd($cek);
      if ($cek == null) {
        DB::table('reg_matkul')->insert([
          'nim' => $nim,
          'semester' => $semester,
          'status' => 'simpan',
        ]);
        return 'simpan';
      }
      return $cek;
    }

    public function getStatusAccMhs($nim) {
      $semester = $this->getTahunAjar();
      $cek = DB::table('reg_matkul')
              ->where('nim', $nim)
              ->where('semester', $this->getTahunAjar())
              ->value('status');
      return $cek;
    }

    public function getJadwalSementaraMhs($nim){
      $statusReg = $this->getStatusRegistrasi();
      $tahunAjar = $this->getTahunAjar();
      $statusAcc = $this->getStatusAccMhs($nim);

      $jadwal = DB::table('jadwal')
      ->join('matkul', 'jadwal.kode_matkul', '=', 'matkul.kode_matkul')
      ->join('reg_matkul_jadwal', 'jadwal.id', '=', 'reg_matkul_jadwal.id_jadwal')      
      ->join('reg_matkul', 'reg_matkul.id', '=', 'reg_matkul_jadwal.id_reg_matkul')      
      ->where('reg_matkul.semester', $tahunAjar)
      ->where('nim', $nim)
      ->get();
      // dd($jadwal);
      return view('dosen.perwalian.index', compact('jadwal', 'statusReg', 'statusAcc', 'nim'));
    }

    public function setAccRegistrasi($nim){
      $tahunAjar = $this->getTahunAjar();
      DB::table('reg_matkul')
      ->where('nim', $nim)
      ->where('semester', $tahunAjar)
      ->update([
        'status' => 'ok',
      ]);
    }

    public function setCancelRegistrasi($nim){
      $tahunAjar = $this->getTahunAjar();
      DB::table('reg_matkul')
      ->where('nim', $nim)
      ->where('semester', $tahunAjar)
      ->update([
        'status' => 'simpan',
      ]);
    }

    public function accReg(Request $request) {
      // dd($request);
      if ($request->okeAcc == 'okeAcc') {
        $this->setAccRegistrasi($request->nim);
      } else if ($request->batal == 'batal') {
        $this->setCancelRegistrasi($request->nim);
      }    
      return redirect('/dosen/kelas/perwalian/' . $request->nim);
    }

}
