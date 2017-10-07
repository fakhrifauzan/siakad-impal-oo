@extends('layouts.template')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Dashboard</div>

          <div class="panel-body">
              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif

              You are logged in! <br>
              {{ Auth::user()->dosen->kode_dosen }} 
          </div>
        </div>
      </div>
    </div>  
  </div>
  <!-- /.container-fluid -->
@endsection
