@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Barang Masuk')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Barang Masuk/</span> Tambah Data</h4>

<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('barangmasuk')}}" method="POST">
          @csrf
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
            <label class="col-sm-2 col-form-label" for="satuan">Barang</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectbarang" name="id_barang" required>
                <option ></option>
                {{-- Diisi secara otomatis --}}
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="selectsuplayer">Suplayer</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectsuplayer" name="id_suplayer" required>
                <option ></option>
                @foreach ($datasuplayer['data']['data'] as $suplayer)
                    <option value="{{$suplayer['id']}}">{{$suplayer['nama']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="jumlah">Jumlah</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="jumlah" name="jumlah" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="tanggal_masuk">Tanggal Masuk</label>
            <div class="col-sm-10">
              <input type="datetime-local" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{\Carbon\Carbon::now()}}" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="harga">Harga</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="harga" name="harga" required/>
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
