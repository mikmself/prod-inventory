@extends('layouts/contentNavbarLayout')
@section('title', 'Kategori')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    Kategori
    <a href="{{route('createkategori')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID Kategori</th>
          <th>Nama Kategori</th>
          <th>Update Terakhir</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data'] as $data)
        <tr>
            <td class="margin-left">{{$data['id']}}</td>
            <td>{{$data['nama_kategori']}}</td>
            <td>{{ \Carbon\Carbon::parse($data['updated_at'])->diffForHumans()}}</td>
            <td class="action">
                <a href="{{route('deletekategori',$data['id'])}}" onclick="return confirm('Apakah anda benar-benar akan menghapusnya?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Striped Rows -->
@endsection
