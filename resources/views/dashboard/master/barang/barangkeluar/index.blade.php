@extends('layouts/contentNavbarLayout')
@section('title', 'Barang Keluar')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang Keluar
    <a href="{{route('addbarangkeluar')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
            <th class="margin-left">ID</th>
            <th>Karyawan</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Tanggal Keluar</th>
            <th>Kegunaan</th>
            <th>Konfirmasi</th>
            <th>Tombol Konfirmasi</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data'] as $data)
        <tr>
          <td class="margin-left">{{$data['id']}}</td>
          <td>{{$data['karyawan']['nama']}}</td>
          <td>{{$data['barang']['nama']}}</td>
          <td>{{$data['jumlah']}}</td>
          <td>{{ \Carbon\Carbon::parse($data['tanggal_keluar'])->isoFormat('dddd, D MMMM Y')}}</td>
          <td>{{$data['kegunaan']}}</td>
          @if ($data['confirm'] == 1)
              <td class="text-success">Ya</td>
          @else
              <td class="text-danger">Belum</td>
              <td class="action">
                  <a href="{{route('confirmbarangkeluar',$data['id'])}}" class="btn btn-secondary">Konfirmasi</a>
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
