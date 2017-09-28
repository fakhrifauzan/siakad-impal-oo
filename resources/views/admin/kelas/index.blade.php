@extends('layouts.template')

@section('content')
  <div class="container-fluid">

    <!-- Example Tables Card -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
        Data Kelas
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>Kode Kelas</th>
                <th>Fakultas</th>
                <th>Program Studi</th>
                <th>Wali Dosen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($kelas as $view)
                  <tr>
                      <td>{{ $view->kode_kelas }}</td>
                      <td>{{ $view->fakultas }}</td>
                      <td>{{ $view->prodi }}</td>
                      <td>{{ $view->doswal }}</td>
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
