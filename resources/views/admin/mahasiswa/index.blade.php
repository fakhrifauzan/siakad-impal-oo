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
              </tr>
            </thead>
            <tbody>
              @foreach($mahasiswa as $view)
                  <tr>
                      <td>{{ $view->nim }}</td>
                      <td>{{ $view->nama }}</td>
                      <td>{{ $view->fakultas }}</td>
                      <td>{{ $view->prodi }}</td>
                      <td>{{ $view->kelas }}</td>
                      <td>{{ $view->tahun_masuk }}</td>
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
