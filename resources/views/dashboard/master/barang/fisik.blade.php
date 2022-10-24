@extends('layouts/contentNavbarLayout')
@section('title', 'Barang Fisik')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang Fisik
  </h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Barang</th>
          <th>Kode</th>
          <th>Status Pengambilan</th>
          <th>Update Terakhir</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data'] as $data)
        <tr>
            <td>{{$data['barang']['nama']}}</td>
            <td>{{$data['kode']}}</td>
            <td>{{$data['status_pengambilan']}}</td>
            <td>{{ \Carbon\Carbon::parse($data['updated_at'])->diffForHumans()}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Striped Rows -->
@endsection
