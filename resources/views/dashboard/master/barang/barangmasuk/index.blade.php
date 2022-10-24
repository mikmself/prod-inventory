@extends('layouts/contentNavbarLayout')
@section('title', 'Barang Masuk')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang Masuk
    <a href="{{route('addbarangmasuk')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
            <th class="margin-left">ID</th>
            <th>Barang</th>
            <th>Suplayer</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Tanggal Masuk</th>
            <th>Pemesan</th>
            <th>Penerima</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data'] as $data)
        <tr>
            <td class="margin-left">{{$data['id']}}</td>
            <td>{{$data['barang']['nama']}}</td>
            <td>{{$data['suplayer']['nama']}}</td>
            <td>{{$data['kategori']['nama_kategori']}}</td>
            <td>{{$data['jumlah']}}</td>
            <td>{{ \Carbon\Carbon::parse($data['tanggal_masuk'])->isoFormat('dddd, D MMMM Y')}}</td>
            <td>{{$data['pemesan']}}</td>
            <td>{{$data['penerima']}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Striped Rows -->
@endsection
