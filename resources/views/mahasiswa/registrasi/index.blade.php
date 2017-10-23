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
                            <button type="button" class="btn btn-default" data-toggle="modal" onclick="cetakKwitansi()">Cetak Kwitansi</button>
                        @else
                          <button type="button" class="btn btn-primary" data-toggle="modal" onclick="view_tagihan({{ $view->id }})">Upload Bukti Pembayaran</button>
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

  <!-- Bukti Pembayaran Modal -->
  <div class="modal fade" id="buktiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buktiModalLabel">Bukti Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label><b><u>Detail Tagihan</u></b></label>
      <div class='form-row'>
          <div class='form-group col-md-6'>
              <label for='selectNIM' class='col-form-label'>NIM</label>
              <input type='text' class='form-control' id='nim' name='nim' readonly>
          </div>
          <div class='form-group col-md-6'>
              <label for='selectSmt' class='col-form-label'>Semester</label>
              <input type='text' class='form-control' id='semester' name='semester' readonly>
          </div>
          <div class='form-group col-md-12'>
              <label for='tagihan' class='col-form-label'>Tagihan</label>
              <input type='number' class='form-control' name='tagihan' id='tagihan' placeholder='4500000' readonly>
          </div>
      </div>
        <form id="formModal">
          {{ csrf_field() }}
          <label><b><u>Detail Pembayaran</u></b></label>
          <div class='form-row'>
              <input type="number" class="form-control" id="id_registrasi" name="id_registrasi" hidden>
              <div class='form-group col-md-6'>
                  <label class='col-form-label'>Tanggal Transfer</label>
                  <input type='date' class='form-control' id='tgl_transfer' name='tgl_transfer'>
              </div>
              <div class='form-group col-md-6'>
                  <label for='bank' class='col-form-label'>Bank Tujuan</label>
                  <select class="form-control" id="bank" name="bank">
                  @php ($bank = ['Bank Mandiri', 'Bank BNI'])
                  @foreach($bank as $value)
                      <option value="{{ $value }}">{{ $value }}</option>
                  @endforeach
                  </select>
              </div>
              <div class='form-group col-md-6'>
                  <label for='jumlah' class='col-form-label'>Jumlah yang Di Transfer</label>
                  <input type='number' class='form-control' id='jumlah' name='jumlah'>
                  </input>
              </div>
              <div class='form-group col-md-6'>
                  <label for='pemilik_rek' class='col-form-label'>Nama Pemilik Rekening</label>
                  <input type='text' class='form-control' id='pemilik_rek' name='pemilik_rek'>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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

        function view_tagihan(id) {
            $('#formModal')[0].reset(); // reset form on modals
            // $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').hide(); // hide  error string
            $('.modal-title').text('Bukti Pembayaran'); // Set Title to Bootstrap modal title
            $("#formModal").attr('action', '{{ url('/mahasiswa/registrasi/tagihan/') }}/');
            $('#formModal').attr('method','post');

            $.get("registrasi/tagihan/"+id+"/get", function (response){
                var value = JSON.parse(response);
                //FILL FORM
                $("#id_registrasi").val(id);                
                $("#nim").val(value[0]["nim"]);
                $("#semester").val(value[0]["semester"]);
                $("#tagihan").val(value[0]["tagihan"]);

                $('#buktiModal').modal('show'); // show bootstrap modal
            });
        }

        function cetakKwitansi(){
          alert('Mohon maaf, fitur ini belum tersedia!');
        }
    </script>
@endsection
