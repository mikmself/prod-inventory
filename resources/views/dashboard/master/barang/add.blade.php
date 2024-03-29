@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Barang')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Barang/</span> Tambah Data</h4>

<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="mb-4">Tambah data masal</h5>
        <form action="{{route('importexcel')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <small>Download contoh file : <a href="{{route('downloadexcel')}}">Download</a></small>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="file">File (Excel)</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="file" name="file" required/>
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

<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="mb-4">Tambah data satuan</h5>
        <form action="{{route('storebarang')}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="nama">Nama Barang</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" name="nama" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="selectkategori">Kategori</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectkategori" name="id_kategori" required>
                <option ></option>
                @foreach ($datakategori['data']['data'] as $kategori)
                    <option value="{{$kategori['id']}}">{{$kategori['nama_kategori']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="satuan">satuan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="satuan" name="satuan" required/>
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
