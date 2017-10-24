@extends('layouts.template')

@section('content')
  <div class="container-fluid">

    <!-- Example Tables Card -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
        Data Nilai Kelas
      </div>
      <div class="card-body">
      <form method="post" action="{{ route('dosen.nilai.submit') }}">
      {{ csrf_field() }}
      <br>
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Kuis</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Indeks</th>               
              </tr>
            </thead>
            <tbody>
              @foreach($nilai as $view)
                  <tr>
                      <td><input type='hidden' value='{{ $view->nim }}' name='nim[]'>{{ $view->nim }}</td>
                      <td>{{ $view->nama }}</td>
                      <td>{{ $view->kelas }}</td>
                      <td><input type='number' min='0' max='100' class='form-control' style='width: 50px' value='{{ $view->kuis }}' placeholder='0' name='kuis[]'></td>
                      <td><input type='number' min='0' max='100' class='form-control' style='width: 50px' value='{{ $view->uts }}' placeholder='0' name='uts[]'></td>
                      <td><input type='number' min='0' max='100' class='form-control' style='width: 50px' value='{{ $view->uas }}' placeholder='0' name='uas[]'></td>
                      <td>{{ $view->indeks }}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>        
      </div>
      <div class="card-footer">
      @if($statusReg == 'Aktif')
        <p class="btn btn-danger btn-block">Sedang berlangsung proses Registrasi</p>
      @else
        <input type="hidden" name="id_jadwal" value="{{ $id }}">
        <button type="submit" class="btn btn-dark btn-block" name="simpanNilai">Simpan</button>
      @endif
      </form>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

@endsection
