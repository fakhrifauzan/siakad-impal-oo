@extends('layouts.template')

@section('content')
  <div class="container-fluid">

    <!-- Example Tables Card -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
        Data Mata Kuliah
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Fakultas</th>
              </tr>
            </thead>
            <tbody>
              @foreach($matkul as $view)
                  <tr>
                      <td>{{ $view->kode_matkul }}</td>
                      <td>{{ $view->nama_matkul }}</td>
                      <td>{{ $view->sks }}</td>
                      <td>{{ $view->fakultas }}</td>
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
