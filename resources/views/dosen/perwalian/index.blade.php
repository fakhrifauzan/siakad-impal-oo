@extends('layouts.template')

@section('content')
  <div class="container-fluid">

    <!-- Example Tables Card -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
        Jadwal Perkuliahan
      </div>
      <div class="card-body">
      <form method="post" action="{{ route('dosen.perwalian.submit') }}">
      {{ csrf_field() }}
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
              </tr>
            </thead>
            <tbody>
              @foreach($jadwal as $view)
                  <tr>
                      <td>{{ $view->kode_matkul }}</td>
                      <td>{{ $view->kode_kelas }}</td>
                      <td>{{ $view->hari }}</td>
                      <td>{{ $view->jam }}</td>
                      <td>{{ $view->hari }}</td>
                      <td>{{ $view->sks }}</td>
                  </tr> 
              @endforeach
            </tbody>
          </table>
        </div>
        @if($statusReg == 'Aktif')
          <div class="card-footer">
            @if ($statusAcc == 'siap' and $statusReg == 'Aktif')
              <input type="number" name="nim" value='{{ $nim }}' hidden>
              <button type="submit" class="btn btn-danger col-md-6" name="batal" value="batal">Batalkan</button>
              <button type="submit" class="btn btn-primary col-md-6" name="okeAcc" value="okeAcc">ACC Registrasi</button>
            @elseif ($statusAcc == 'simpan' and $statusReg == 'Aktif')
              <p class="btn btn-warning btn-block">Mahasiswa Belum Siap ACC</p>
            @elseif ($statusAcc == 'ok')
              <p class="btn btn-info btn-block">Sudah Anda ACC</p>
            @endif
          </div>
        @else
          <div class="card-footer">
            <p class="btn btn-info btn-block">Masa Registrasi Tidak Aktif</p>
          </div>  
        @endif        
        </form>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->
@endsection
