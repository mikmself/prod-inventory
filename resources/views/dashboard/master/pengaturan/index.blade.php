@extends('layouts/contentNavbarLayout')
@section('title', 'Pengaturan')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    Pengaturan
    <a href="{{route('createpengaturan')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="margin-left">ID Pengaturan</th>
          <th>Key</th>
          <th>Value</th>
          <th>Update Terakhir</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data']['data'] as $pengaturan)
        <tr>
            <td class="margin-left">{{$pengaturan['id']}}</td>
            <td>{{$pengaturan['key']}}</td>
            <td>{{$pengaturan['value']}}</td>
            <td>{{ \Carbon\Carbon::parse($pengaturan['updated_at'])->diffForHumans()}}</td>
            <td class="action">
                <a href="{{route('editpengaturan',$pengaturan['id'])}}" class="btn btn-warning">Ubah</a>
                <a href="{{route('deletepengaturan',$pengaturan['id'])}}" onclick="return confirm('Apakah anda benar-benar akan menghapusnya?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspagepengaturan')}}" method="post">
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
        <form action="{{route('gotopagepengaturan')}}" method="post">
          @csrf
          <input type="hidden" name="link" value="{{$data['data']['links'][$i]['url']}}">
          <button type="submit" class="bg-transparent">{{$i}}</button>
        </form>
      @endfor
    </div>
    @endif
    <form action="{{route('nextpagepengaturan')}}" method="post">
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
