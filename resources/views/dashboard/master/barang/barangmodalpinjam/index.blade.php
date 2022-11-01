@extends('layouts/contentNavbarLayout')
@section('title', 'Barang Modal Pinjam')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang Modal Pinjam
    <a href="{{route('addbarangmodalpinjam')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="margin-left">ID</th>
          <th>User</th>
          <th>Barang</th>
          <th>Barang Fisik</th>
          <th>Tanggal Keluar</th>
          <th>Kegunaan</th>
          <th>Tanggal Kembali</th>
          <th>Konfirmasi</th>
          <th>Tombol Konfirmasi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data'] as $data)
        <tr>
            <td class="margin-left">{{$data['id']}}</td>
            <td>{{$data['user']['firstname'] . " " . $data['user']['lastname']}}</td>
            <td>{{$data['barang']['nama']}}</td>
            <td>{{$data['barangfisik']['kode']}}</td>
            <td>{{ \Carbon\Carbon::parse($data['tanggal_keluar'])->isoFormat('dddd, D MMMM Y')}}</td>
            <td>{{$data['kegunaan']}}</td>
            <td>{{ \Carbon\Carbon::parse($data['tanggal_kembali'])->isoFormat('dddd, D MMMM Y')}}</td>
            @if ($data['confirm'] == 1)
                <td class="text-success">Ya</td>
            @else
                <td class="text-danger">Belum</td>
                <td class="action">
                    <a href="{{route('confirmbarangmodalpinjam',$data['id_barang'])}}" class="btn btn-secondary">Konfirmasi</a>
                </td>
            @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Striped Rows -->
@endsection
