@extends('layouts/contentNavbarLayout')
@section('title', 'ACC Barang Modal Kembali')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    ACC Barang Modal Kembali
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Barang</th>
          <th>Kode Barang</th>
          <th>Tanggal Keluar</th>
          <th>Tanggal Kembali</th>
          <th>Konfirmasi Barang Kembali</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data as $barangkembali)
        <tr>
          <td class="margin-left">{{$barangkembali['id']}}</td>
          <td>{{$barangkembali['barang']['nama']}}</td>
          <td>{{$barangkembali['barangfisik']['kode']}}</td>
          <td>{{ \Carbon\Carbon::parse($barangkembali['tanggal_keluar'])->isoFormat('dddd, D MMMM Y')}}</td>
          <td>{{ \Carbon\Carbon::parse($barangkembali['tanggal_kembali'])->isoFormat('dddd, D MMMM Y')}}</td>
          <td><a href="{{route('barangmodalkembali',$barangkembali['id'])}}" class="btn btn-warning">ACC</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Striped Rows -->
@endsection
