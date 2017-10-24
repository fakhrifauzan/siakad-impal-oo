@extends('layouts.template')

@section('content')
  <div class="container-fluid">

    <!-- Example Tables Card -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
          Registrasi Mata Kuliah
      </div>
      <div class="card-body">
      <form method="post" action="{{ route('mahasiswa.registrasi.matkul.submit') }}">
      {{ csrf_field() }}
      <br>
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>Mata Kuliah</th>
                <th>Kelas</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Ruangan</th>
                <th>SKS</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($matkul as $view)
                  <tr>
                      <td>{{ $view->kode_matkul }}</td>
                      <td>{{ $view->kode_kelas }}</td>
                      <td>{{ $view->hari }}</td>
                      <td>{{ $view->jam }}</td>
                      <td>{{ $view->ruangan }}</td>
                      <td>{{ $view->sks }}</td>
                      <td>
                        <input type='checkbox' class='form-control' name='jadwal[]' value='{{ $view->id }}'
                        @if($status != 'simpan')
                          disabled
                        @endif
                        @foreach ($pilihan as $pilih)
                          @if($pilih->id_jadwal == $view->id)
                            checked
                          @endif
                        @endforeach
                        >
                      </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @if($stat_reg == 'Aktif')
          <div class="card-footer">
            @if ($status == 'simpan' and $stat_reg == 'Aktif')
              <button type="submit" class="btn btn-dark col-md-6" name="simpan" value="simpan">Simpan</button>
              <button type="submit" class="btn btn-warning col-md-6" name="siapAcc" value="siapAcc">Siap ACC</button>
            @elseif ($status == 'ok')
              <a href="../jadwal"><p class="btn btn-primary btn-block">Registrasi telah di ACC Dosen Wali</p></a>
            @else
              <p class="btn btn-danger btn-block">Menunggu Proses ACC Dosen Wali</p>
            @endif
          </div>        
        @endif        
        </form>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->
@endsection