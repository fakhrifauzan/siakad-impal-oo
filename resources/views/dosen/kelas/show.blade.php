@extends('layouts.template')

@section('content')
  <div class="container-fluid">

    <!-- Example Tables Card -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
        Data Mahasiswa
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Fakultas</th>
                <th>Program Studi</th>
                <th>Kelas</th>
                <th>Tahun Masuk</th>
                <th>Registrasi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($mahasiswa as $view)
                  <tr>
                      <td>{{ $view->nim }}</td>
                      <td>{{ $view->user->name }}</td>
                      <td>{{ $view->user->fakultas }}</td>
                      <td>{{ $view->prodi }}</td>
                      <td>{{ $view->kode_kelas }}</td>
                      <td>{{ $view->tahun_masuk }}</td>
                      <td>
                        <a href='registasi/{{ $view->nim }}'>
                            <button type='button' class='btn btn-primary'>Detail Registrasi</button>
                        </a>
                      </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->
@endsection
