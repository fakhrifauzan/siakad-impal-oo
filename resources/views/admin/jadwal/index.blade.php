@extends('layouts.template')

@section('content')
  <div class="container-fluid">

    <!-- Example Tables Card -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
        Data Jadwal
      </div>
      <div class="card-body">
      <div class="col-md-12">
        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="add_jadwal()">
          Tambah Jadwal Perkuliahan
        </button>
      </div>
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
                          <button type="button" class="btn btn-warning" data-toggle="modal" onclick="edit_jadwal({{ $view->id }})"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <form action="/jadwal/{{ $view->id }}" method="post">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <button type="submit" name="submit" value="Delete" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          </form>
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

  <!-- Input Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formModal">
            {{ csrf_field() }}
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="selectDosen" class="col-form-label">Kode Dosen</label>
                <select id="selectDosen" class="form-control" name="kode_dosen">
                  <option selected>Choose...</option>
                  @foreach($dosen as $view)
                      <option value="{{ $view->kode_dosen }}">{{ $view->kode_dosen }} | {{ $view->nama_dosen }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="selectMatkul" class="col-form-label">Mata Kuliah</label>
                <select id="selectMatkul" class="form-control" name="kode_matkul">
                  <option selected>Choose...</option>
                  @foreach($matkul as $view)
                      <option value="{{ $view->kode_matkul }}">{{ $view->nama_matkul }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="selectKelas" class="col-form-label">Kelas</label>
                <select id="selectKelas" class="form-control" name="kode_kelas">
                  <option selected>Choose...</option>
                  @foreach($kelas as $view)
                      <option value="{{ $view->kode_kelas }}">{{ $view->kode_kelas }}</option>
                  @endforeach
                </select>
              </div>
                <div class="form-group col-md-6">
                    <label for="tahun_ajar" class="col-form-label">Semester</label>
                    <select  id="selectSemester" class="form-control" name="semester">
                        <option selected>Choose...</option>
                        @php ($tahun = ['1516/1', '1516/2', '1617/1', '1617/2', '1718/1', '1718/2'])
                        @foreach($tahun as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="selectHari" class="col-form-label">Hari</label>
                <select id="selectHari" class="form-control" name="hari">
                  <option selected>Choose...</option>
                  @php ($hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'])
                  @foreach($hari as $value)
                      <option value="{{ $value }}">{{ $value }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="selectJam" class="col-form-label">Jam</label>
                <select id="selectJam" class="form-control" name="jam">
                  <option selected>Choose...</option>
                  @php ($jam = ['06.30 - 09.30', '09.30 - 12.30', '12.30 - 15.30', '15.30 - 18.30'])
                  @foreach($jam as $value)
                      <option value="{{ $value }}">{{ $value }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="selectRuangan" class="col-form-label">Ruangan</label>
                <select id="selectRuangan" class="form-control" name="ruangan">
                  <option selected>Choose...</option>
                  @php ($ruangan = ['A307', 'A207B', 'B105', 'E302', 'E301', 'B208'])
                  @foreach($ruangan as $value)
                      <option value="{{ $value }}">{{ $value }}</option>
                  @endforeach
                </select>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="addJadwal">Submit</button>
        </div>
      </div>
        </form>
    </div>
  </div>

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
            $('#formModal').attr('action','{{ url('/jadwal') }}');
        }

        function edit_jadwal(id) {
            $('#formModal')[0].reset(); // reset form on modals
            // $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').hide(); // hide  error string
            $('.modal-title').text('Edit Jadwal'); // Set Title to Bootstrap modal title
            $("#formModal").attr('action', '{{ url('/jadwal') }}/'+id);
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
