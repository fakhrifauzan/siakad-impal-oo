@extends('layouts.template')

@section('content')
  <div class="container-fluid">

    <!-- Example Tables Card -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
        Data Nilai
      </div>
      <div class="card-body">
      <br>
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>Kode Dosen</th>
                <th>Mata Kuliah</th>
                <th>Kelas</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Ruangan</th>
                <th>Semester</th>
                <th>Aksi</th>                
              </tr>
            </thead>
            <tbody>
              @foreach($jadwal as $view)
                  <tr>
                      <td>{{ $view->kode_dosen }}</td>
                      <td>{{ $view->kode_matkul }}</td>
                      <td>{{ $view->kode_kelas }}</td>
                      <td>{{ $view->hari }}</td>
                      <td>{{ $view->jam }}</td>
                      <td>{{ $view->ruangan }}</td>
                      <td>{{ $view->semester }}</td>
                      <td>
                        <a href='nilai/{{ $view->id }}'>
                            <button type='button' class='btn btn-default'>Detail Kelas</button>
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
