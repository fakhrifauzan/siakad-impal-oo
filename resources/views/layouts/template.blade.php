<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>Administrator</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('vendor/popper/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

  </head>


  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href="#">Sistem Informasi Akademik</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="{{ url('home') }}">
              <i class="fa fa-fw fa-home"></i>
              <span class="nav-link-text">
                Dashboard</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
            <a class="nav-link" href="{{ url('dosen') }}">
              <i class="fa fa-fw fa-user-circle-o"></i>
              <span class="nav-link-text">
                Dosen</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
            <a class="nav-link" href="{{ url('jadwal') }}">
              <i class="fa fa-fw fa-calendar"></i>
              <span class="nav-link-text">
                Jadwal Perkuliahan</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
            <a class="nav-link" href="{{ url('kelas') }}">
              <i class="fa fa-fw fa-graduation-cap"></i>
              <span class="nav-link-text">
                Kelas</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
            <a class="nav-link" href="{{ url('mahasiswa') }}">
              <i class="fa fa-fw fa-user"></i>
              <span class="nav-link-text">
                Mahasiswa</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
            <a class="nav-link" href="{{ url('matkul') }}">
              <i class="fa fa-fw fa-book"></i>
              <span class="nav-link-text">
               Mata Kuliah</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
            <a class="nav-link" href="{{ url('registrasi') }}">
              <i class="fa fa-fw fa-pencil-square-o"></i>
              <span class="nav-link-text">
                Registasi</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <a class="nav-link" href="{{ url('/logout') }}">
                  <i class="fa fa-fw fa-sign-out"></i>
                  Logout</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="content-wrapper">

      @yield('content')

    </div>
    <!-- /.content-wrapper -->

    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright &copy; Sistem Informasi Akademik <?php echo date('Y'); ?></small>
        </div>
      </div>
    </footer>


    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

  </body>

</html>
