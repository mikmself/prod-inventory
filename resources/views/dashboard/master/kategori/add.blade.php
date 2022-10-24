@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Kategori')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kategori/</span> Tambah Data</h4>

<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('storekategori')}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="nama-kategori">Nama Kategori</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama-kategori" name="nama_kategori" required/>
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
