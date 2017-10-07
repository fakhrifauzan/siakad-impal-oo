@extends('layouts.template')

@section('content')
  <div class="container-fluid">

    <!-- Example Tables Card -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
        Data Dosen
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>Kode Dosen</th>
                <th>Nama</th>
                <th>Fakultas</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dosen as $view)
                  <tr>
                      <td>{{ $view->kode_dosen }}</td>
                      <td>{{ $view->user->name }}</td>
                      <td>{{ $view->user->fakultas }}</td>
                      <td>{{ $view->status }}</td>
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
