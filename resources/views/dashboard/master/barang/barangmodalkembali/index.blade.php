@extends('layouts/contentNavbarLayout')
@section('title', 'Barang Modal Kembali')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang Modal Kembali
    <a href="{{route('addbarangmodalkembali')}}" class="btn btn-primary">Acc Barang Kembali</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Barang</th>
          <th>Tanggal Kembali</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data'] as $data)
        <tr>
          <td class="margin-left">{{$data['id']}}</td>
          <td>{{$data['barang']['nama']}}</td>
          <td>{{ \Carbon\Carbon::parse($data['tanggal_kembali'])->isoFormat('dddd, D MMMM Y')}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Striped Rows -->
@endsection
