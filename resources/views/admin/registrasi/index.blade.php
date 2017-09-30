@extends('layouts.template')

@section('content')
  <div class="container-fluid">

    <!-- Example Tables Card -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
        Data Registrasi
      </div>
      <div class="card-body">
      <div class="col-md-12">
        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="add_tagihan()">
          Tambah Tagihan Registrasi
        </button>
        <button type="button" class="btn btn-warning" data-toggle="modal" onclick="config()">
          Pengaturan Registrasi
        </button>
      </div>
      <br>
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>NIM</th>
                <th>Semester</th>
                <th>Tagihan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($registrasi as $view)
                  <tr>
                      <td>{{ $view->nim }}</td>
                      <td>{{ $view->semester }}</td>
                      <td>{{ $view->tagihan }}</td>
                      <td>{{ $view->status }}</td>
                      <td>
                        @if ($view->status == 'Lunas')
                          <button type="button" class="btn btn-primary" data-toggle="modal" onclick="edit_jadwal({{ $view->id }})">Lihat Bukti Pembayaran</button>
                            <button type="button" class="btn btn-default" data-toggle="modal" onclick="edit_jadwal({{ $view->id }})">Cetak Kwitansi</button>
                        @else
                          <button type="button" class="btn btn-warning" data-toggle="modal" onclick="edit_tagihan({{ $view->id }})">Edit</button>
                          <form action="/registrasi/{{ $view->id }}" method="post">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <button type="submit" name="submit" value="Delete" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          </form>
                        @endif
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
                <label for="selectNIM" class="col-form-label">NIM</label>
                <select id="selectNIM" class="form-control" name="nim">
                  <option selected>Choose...</option>
                    @foreach($mahasiswa as $view)
                        <option value="{{ $view->nim }}">{{ $view->nim }} | {{ $view->nama }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="selectSmt" class="col-form-label">Semester</label>
                <select id="selectSmt" class="form-control" name="semester">
                  <option selected>Choose...</option>
                    @php ($tahun = ['1516/1', '1516/2', '1617/1', '1617/2', '1718/1', '1718/2'])
                    @foreach($tahun as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group col-md-12">
                <label for="tagihan" class="col-form-label">Tagihan</label>
                <input id="tagihan" type="number" class="form-control" name="tagihan" placeholder="4500000">
              </div>
              <div class="form-group col-md-12">
                <label for="selectStatus" class="col-form-label">Status</label>
                <select id="selectStatus" class="form-control" name="status">
                  <option value="Belum Lunas" selected>Belum Lunas</option>
                  <option value="Lunas">Lunas</option>
                </select>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="addTagihan">Submit</button>
        </div>
      </div>
        </form>
    </div>
  </div>

  <!-- Konfigurasi Modal -->
  <div class="modal fade" id="configModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <div class="form-group col-md-12">
                <label for="statusRegistrasi" class="col-form-label">Status Registrasi</label>
                <select id="selectStatus" class="form-control" name="status">
                  <option>Choose...</option>
                    @php ($status = ['Aktif', 'Tidak Aktif'])
                    @foreach($status as $value)
                        <option value="{{ $value }}" {{($statusReg == $value) ? 'selected':''}}>{{ $value }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group col-md-12">
                  <label for="tahun_ajar" class="col-form-label">Semester</label>
                  <select  id="selectTahunAjar" class="form-control" name="tahun_ajar">
                      <option selected>Choose...</option>
                      @php ($tahun = ['1516/1', '1516/2', '1617/1', '1617/2', '1718/1', '1718/2'])
                      @foreach($tahun as $value)
                          <option value="{{ $value }}" {{($tahunAjar == $value) ? 'selected':''}}>{{ $value }}</option>
                      @endforeach
                  </select>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="addTagihan">Submit</button>
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

        function config() {
            $('#configModal').modal('show'); // show bootstrap modal
            $('.modal-title').text('Pengaturan Registrasi'); // Set Title to Bootstrap modal title
            $('#formModal').attr('method','post');
            $('#formModal').attr('action','{{ url('/registrasi') }}');
        }

        function add_tagihan() {
            $('#formModal')[0].reset(); // reset form on modals
            // $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').show(); // show error string
            $('#myModal').modal('show'); // show bootstrap modal
            $('.modal-title').text('Tambah Tagihan Registrasi'); // Set Title to Bootstrap modal title
            $('#formModal').attr('method','post');
            $('#formModal').attr('action','{{ url('/registrasi') }}');
        }

        function edit_tagihan(id) {
            $('#formModal')[0].reset(); // reset form on modals
            // $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').hide(); // hide  error string
            $('.modal-title').text('Edit Tagihan Registrasi'); // Set Title to Bootstrap modal title
            $("#formModal").attr('action', '{{ url('/registrasi') }}/'+id);
            $('#formModal').attr('method','post');
            $('#formModal').prepend('{{ method_field('PUT') }}');

            $.get("registrasi/"+id+"/edit", function (response){
                var value = JSON.parse(response);
                //FILL FORM
                $("#selectNIM").val(value["nim"]);
                $("#selectSmt").val(value["semester"]);
                $("#tagihan").val(value["tagihan"]);
                $("#selectStatus").val(value["status"]);

                $('#myModal').modal('show'); // show bootstrap modal
            });
        }
    </script>
@endsection
