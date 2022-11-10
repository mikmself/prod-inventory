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
    <table class="table table-striped">
      <thead>
        <tr>
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
    @if ($data['data']['links'][2]['url'] == null)

    @else
    <div class="container d-flex justify-content-evenly align-items-center">
      @for($i = 1; $i<=count($data['data']['links'])-1;$i++)
        <form action="{{route('gotopagesuplayer')}}" method="post">
          @csrf
          <input type="hidden" name="link" value="{{$data['data']['links'][$i]['url']}}">
          <button type="submit" class="bg-transparent border-transparent">{{$i}}</button>
        </form>
      @endfor
    </div>
    @endif
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
