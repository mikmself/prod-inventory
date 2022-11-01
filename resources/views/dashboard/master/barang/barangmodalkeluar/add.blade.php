@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Barang Modal Keluar')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Barang/</span> Barang Modal Keluar</h4>

<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('barangmodalkeluar')}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="tanggal_keluar">Tanggal Keluar</label>
            <div class="col-sm-10">
              <input type="datetime-local" class="form-control" id="tanggal_keluar" name="tanggal_keluar" value="{{\Carbon\Carbon::now()}}" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="selectruang">Ruang</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectruang" name="id_ruang" required>
                <option ></option>
                @foreach ($dataruang['data'] as $ruang)
                    <option value="{{$ruang['id']}}">{{$ruang['nama']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="selectuser">User</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectuser" name="id_user" required>
                <option ></option>
                @foreach ($datauser['data'] as $user)
                    <option value="{{$user['id']}}">{{$user['firstname'] . " " . $user['lastname']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="selectbarang">Barang</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectbarang" name="id_barang" onchange="selectbarangchange()" required>
                <option ></option>
                @foreach ($databarang as $barang)
                    <option value="{{$barang['id']}}">{{$barang['nama']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="selectbarangfisik">Barang Fisik</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectbarangfisik" name="id_barang_fisik[]" multiple="multiple" required>

              </select>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function selectbarangchange(){
  let selectbarang = document.getElementById('selectbarang');
  $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type : 'POST',
      url : '/admin/dashboard/master/barang/getspesifikbarangfisik',
      data : 'idbarang='+selectbarang.value,
      success : function(response){
          $('#selectbarangfisik').html(response);
      }
  });
}
</script>
@endsection
