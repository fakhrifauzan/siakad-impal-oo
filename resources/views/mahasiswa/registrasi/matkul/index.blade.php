@extends('layouts.template')

@section('content')
  <div class="container-fluid">

    <!-- Example Tables Card -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
          Registrasi Mata Kuliah
      </div>
      <div class="card-body">
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
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($matkul as $view)
                  <tr>
                      <td>{{ $view->kode_matkul }}</td>
                      <td>{{ $view->kode_kelas }}</td>
                      <td>{{ $view->hari }}</td>
                      <td>{{ $view->jam }}</td>
                      <td>{{ $view->ruangan }}</td>
                      <td>{{ $view->sks }}</td>
                      <td>
                        <input type='chekcbox' class='form-control' name='jadwal[]' value='{{ $view->id_jadwal }}'>
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

  <script type="text/javascript">
        $(document).ready(function () {
            // $('#member').select2({
            //     placeholder: 'Select a member',
            // });
        });

        $('#myModal').on('hide.bs.modal', function (event) {
            $('#formModal').removeAttr("action");
            $('#formModal').removeAttr("method");
            $("input[name='_method']").remove();
            $("option").removeAttr("selected");
            $("#member").val('').trigger('change');
        });

        function add_jadwal() {
            $('#formModal')[0].reset(); // reset form on modals
            // $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').show(); // show error string
            $('#myModal').modal('show'); // show bootstrap modal
            $('.modal-title').text('Tambah Jadwal'); // Set Title to Bootstrap modal title
            $('#formModal').attr('method','post');
            $('#formModal').attr('action','{{ route('admin.jadwal.store') }}');
        }

        function edit_jadwal(id) {
            $('#formModal')[0].reset(); // reset form on modals
            // $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').hide(); // hide  error string
            $('.modal-title').text('Edit Jadwal'); // Set Title to Bootstrap modal title
            $("#formModal").attr('action', '{{ url('admin/jadwal') }}/'+id);
            $('#formModal').attr('method','post');
            $('#formModal').prepend('{{ method_field('PUT') }}');

            $.get("jadwal/"+id+"/edit", function (response){
                var value = JSON.parse(response);

                //FILL FORM
                $("#selectDosen").val(value["kode_dosen"]);
                $("#selectMatkul").val(value["kode_matkul"]);
                $("#selectKelas").val(value["kode_kelas"]);
                $("#selectSemester").val(value["semester"]);
                $("#selectHari").val(value["hari"]);
                $("#selectJam").val(value["jam"]);
                $("#selectRuangan").val(value["ruangan"]);

                // var id = project["users"];
                //
                // var members = [];
                //
                // for (var i = 0; i < id.length; i++) {
                //     members.push(id[i]["id"]);
                //     $("#member option[value='" + id[i]["id"] + "']").attr("selected", 1);
                // }
                // $("#member").val(members).trigger('change');

                $('#myModal').modal('show'); // show bootstrap modal
            });
        }
    </script>
@endsection
