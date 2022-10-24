@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Barang')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Barang/</span> Edit Data</h4>

<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('updatebarang',$data['data']['id'])}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="nama">Nama Barang</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" name="nama" value="{{$data['data']['nama']}}" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="selectkategori">Password</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectkategori" name="id_kategori" required>
                <option ></option>
                @foreach ($datakategori['data'] as $kategori)
                    <option {{$data['data']['id_kategori'] == $kategori['id'] ? "selected" : ""}} value="{{$kategori['id']}}">{{$kategori['nama_kategori']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="satuan">satuan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="satuan" name="satuan" value="{{$data['data']['satuan']}}" required/>
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
@endsection
