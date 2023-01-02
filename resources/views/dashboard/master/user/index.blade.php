@extends('layouts/contentNavbarLayout')
@section('title', 'User')
@section('content')
<!-- Striped Rows -->
<div class="card">
  <h5 class="card-header d-flex justify-content-between align-items-center">
    User
    <div>
      <a href="{{route('userexportexcel')}}" class="btn btn-secondary">Export Data</a>
      <a href="{{route('createuser')}}" class="btn btn-primary">Tambah Data</a>
    </div>
  </h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="margin-left">ID user</th>
          <th>Nama</th>
          <th>NIP</th>
          <th>Email</th>
          <th>No Telephone</th>
          <th>Level</th>
          <th>Update Terakhir</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data']['data'] as $datauser)
        <tr>
            <td class="margin-left">{{$datauser['id']}}</td>
            <td>{{$datauser['firstname']}} {{$datauser['lastname']}}</td>
            <td>{{$datauser['email']}}</td>
            <td>{{$datauser['nip']}}</td>
            <td>{{$datauser['notelp']}}</td>
            <td>{{$datauser['level']}}</td>
            <td>{{ \Carbon\Carbon::parse($datauser['updated_at'])->diffForHumans()}}</td>
            <td class="action">
                <a href="{{route('edituser',$datauser['id'])}}" class="btn btn-warning">Ubah</a>
                <a href="{{route('deleteuser',$datauser['id'])}}" onclick="return confirm('Apakah anda benar-benar akan menghapusnya?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspageuser')}}" method="post">
      @csrf
      <input type="hidden" name="link" value="{{$data['data']['prev_page_url']}}">
      @if ($data['data']['prev_page_url'] == null)
        <button class="btn btn-dark pull-left visually-hidden" type="submit">Previous</button>
      @else
        <button class="btn btn-dark pull-left" type="submit">Previous</button>
      @endif
    </form>
    
    <form action="{{route('nextpageuser')}}" method="post">
      @csrf
      <input type="hidden" name="link" value="{{$data['data']['next_page_url']}}">
      @if ($data['data']['next_page_url'] == null)
        <button class="btn btn-warning pull-right visually-hidden" type="submit">Next</button>
      @else
        <button class="btn btn-warning pull-right" type="submit">Next</button>
      @endif
    </form>
  </div>
</div>
<!--/ Striped Rows -->
@endsection
