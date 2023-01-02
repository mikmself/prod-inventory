@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Barang Keluar')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Barang/</span> Barang Keluar</h4>

<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('barangkeluar')}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="tanggal_keluar">Tanggal Keluar</label>
            <div class="col-sm-10">
              <input type="datetime-local" class="form-control" id="tanggal_keluar" name="tanggal_keluar" value="{{\Carbon\Carbon::now()}}" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="selectuser">User</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectunitkerja" name="id_unitkerja" required>
                <option ></option>
                @foreach ($dataunitkerja['data'] as $unitkerja)
                    <option value="{{$unitkerja['id']}}">{{$unitkerja['nama']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div id="formbarangkeluar">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="selectbarang">Barang</label>
              <div class="col-sm-10">
                <select class="form-control" id="selectbarang" name="id_barang[]" required>
                  <option ></option>
                  @foreach ($databarang as $barang)
                      <option value="{{$barang['id']}}">{{$barang['nama']}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="jumlah[]">Jumlah Barang</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="jumlah[]" name="jumlah[]" min="0" required/>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="kegunaan">Kegunaan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="kegunaan" name="kegunaan" min="0" required/>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="button" class="btn btn-secondary" onclick="getinputbarangkeluar()">Tambah Input Barang</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function getinputbarangkeluar(){
  $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type : 'GET',
      url : '/admin/dashboard/master/barang/getinputbarangkeluar',
      data : [],
      success : function(response){
          $('#formbarangkeluar').append(response);
      }
  })
}
</script>
@endsection
