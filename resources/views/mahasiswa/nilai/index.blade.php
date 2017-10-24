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
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>Kode Matkul</th>
                <th>Nama Matkul</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Kuis</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Indeks</th>               
              </tr>
            </thead>
            <tbody>
              @foreach($nilai as $view)
                  <tr>
                      <td>{{ $view->kode_matkul }}</td>
                      <td>{{ $view->nama_matkul }}</td>
                      <td>{{ $view->sks }}</td>
                      <td>{{ $view->semester }}</td>
                      <td>{{ $view->kuis }}</td>
                      <td>{{ $view->uts }}</td>
                      <td>{{ $view->uas }}</td>                      
                      <td>{{ $view->indeks }}</td>
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
