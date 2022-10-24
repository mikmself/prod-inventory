@extends('layouts/contentNavbarLayout')
@section('title', 'Karyawan')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    Karyawan
    <a href="{{route('createkaryawan')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="margin-left">ID karyawan</th>
          <th>Nama</th>
          <th>Status</th>
          <th>Unit Kerja</th>
          <th>Update Terakhir</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data'] as $data)
        <tr>
            <td class="margin-left">{{$data['id']}}</td>
            <td>{{$data['nama']}}</td>
            <td>{{$data['status']}}</td>
            <td>{{$data['unit_kerja']}}</td>
            <td>{{ \Carbon\Carbon::parse($data['updated_at'])->diffForHumans()}}</td>
            <td class="action">
                <a href="{{route('editkaryawan',$data['id'])}}" class="btn btn-warning">Ubah</a>
                <a href="{{route('deletekaryawan',$data['id'])}}" onclick="return confirm('Apakah anda benar-benar akan menghapusnya?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Striped Rows -->
@endsection
