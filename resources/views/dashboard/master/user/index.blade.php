@extends('layouts/contentNavbarLayout')
@section('title', 'User')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    User
    <a href="{{route('createuser')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="margin-left">ID user</th>
          <th>Name</th>
          <th>Email</th>
          <th>No Telephone</th>
          <th>Level</th>
          <th>Update Terakhir</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data'] as $data)
        <tr>
            <td class="margin-left">{{$data['id']}}</td>
            <td>{{$data['firstname']}} {{$data['lastname']}}</td>
            <td>{{$data['email']}}</td>
            <td>{{$data['notelp']}}</td>
            <td>{{$data['level']}}</td>
            <td>{{ \Carbon\Carbon::parse($data['updated_at'])->diffForHumans()}}</td>
            <td class="action">
                <a href="{{route('edituser',$data['id'])}}" class="btn btn-warning">Ubah</a>
                <a href="{{route('deleteuser',$data['id'])}}" onclick="return confirm('Apakah anda benar-benar akan menghapusnya?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Striped Rows -->
@endsection
