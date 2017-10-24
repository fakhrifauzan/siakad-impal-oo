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
        <div class="col-md-12">
            <a class="btn btn-primary btn-block" href="jadwal/sementara">
                Jadwal Sementara
            </a>
        </div>
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
              </tr>
            </thead>
            <tbody>
              @foreach($jadwal as $view)
                  <tr>
                      <td>{{ $view->kode_matkul }}</td>
                      <td>{{ $view->kode_kelas }}</td>
                      <td>{{ $view->hari }}</td>
                      <td>{{ $view->jam }}</td>
                      <td>{{ $view->ruangan }}</td>
                      <td>{{ $view->sks }}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>     
        </form>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->
@endsection