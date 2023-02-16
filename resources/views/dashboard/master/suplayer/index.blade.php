@extends('layouts/contentNavbarLayout')
@section('title', 'Suplayer')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    Suplayer
    <a href="{{route('createsuplayer')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <form action="{{ route('multipledeletesuplayer') }}" method="POST">
      @csrf
      <table class="table table-striped">
        <thead>
          <tr>
            <th></th>
            <th class="margin-left">ID Suplayer</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Telephone</th>
            <th>Update Terakhir</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($data['data']['data'] as $suplayer)
          <tr>
              <td><input type="checkbox" name="arrayId[]" value="{{ $suplayer['id'] }}" class="form-check-input"></td>
              <td class="margin-left">{{$suplayer['id']}}</td>
              <td>{{$suplayer['nama']}}</td>
              <td>{{$suplayer['alamat']}}</td>
              <td>{{$suplayer['nohp']}}</td>
              <td>{{ \Carbon\Carbon::parse($suplayer['updated_at'])->diffForHumans()}}</td>
              <td class="action">
                  <a href="{{route('editsuplayer',$suplayer['id'])}}" class="btn btn-warning">Ubah</a>
                  <a href="{{route('deletesuplayer',$suplayer['id'])}}" onclick="return confirm('Apakah anda benar-benar akan menghapusnya?')" class="btn btn-danger">Hapus</a>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <button class="btn btn-danger m-4">Multiple Delete</button>
    </form>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspagesuplayer')}}" method="post">
      @csrf
      <input type="hidden" name="link" value="{{$data['data']['prev_page_url']}}">
      @if ($data['data']['prev_page_url'] == null)
        <button class="btn btn-dark pull-left visually-hidden" type="submit">Previous</button>
      @else
        <button class="btn btn-dark pull-left" type="submit">Previous</button>
      @endif
    </form>
    
    <form action="{{route('nextpagesuplayer')}}" method="post">
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
