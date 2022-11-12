@extends('layouts/contentNavbarLayout')
@section('title', 'Ruang')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    Ruang
    <a href="{{route('createruang')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="margin-left">ID ruang</th>
          <th>Nama</th>
          <th>Update Terakhir</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data']['data'] as $ruang)
        <tr>
            <td class="margin-left">{{$ruang['id']}}</td>
            <td>{{$ruang['nama']}}</td>
            <td>{{ \Carbon\Carbon::parse($ruang['updated_at'])->diffForHumans()}}</td>
            <td class="action">
                <a href="{{route('editruang',$ruang['id'])}}" class="btn btn-warning">Ubah</a>
                <a href="{{route('deleteruang',$ruang['id'])}}" onclick="return confirm('Apakah anda benar-benar akan menghapusnya?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspageruang')}}" method="post">
      @csrf
      <input type="hidden" name="link" value="{{$data['data']['prev_page_url']}}">
      @if ($data['data']['prev_page_url'] == null)
        <button class="btn btn-dark pull-left visually-hidden" type="submit">Previous</button>
      @else
        <button class="btn btn-dark pull-left" type="submit">Previous</button>
      @endif
    </form>
    
    <form action="{{route('nextpageruang')}}" method="post">
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
