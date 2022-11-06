@extends('layouts/contentNavbarLayout')
@section('title', 'Barang Keluar')
@section('content')
<div class="card">
  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang Keluar
    <a href="{{route('addbarangkeluar')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
            <th class="margin-left">ID</th>
            <th>User</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Tanggal Keluar</th>
            <th>Kegunaan</th>
            <th>Konfirmasi</th>
            <th>Tombol Konfirmasi</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data']['data'] as $barangkeluar)
        <tr>
          <td class="margin-left">{{$barangkeluar['id']}}</td>
          <td>{{$barangkeluar['user']['firstname'] . " " . $barangkeluar['user']['lastname']}}</td>
          <td>{{$barangkeluar['barang']['nama']}}</td>
          <td>{{$barangkeluar['jumlah']}}</td>
          <td>{{ \Carbon\Carbon::parse($barangkeluar['tanggal_keluar'])->isoFormat('dddd, D MMMM Y')}}</td>
          <td>{{$barangkeluar['kegunaan']}}</td>
          @if ($barangkeluar['confirm'] == 1)
              <td class="text-success">Ya</td>
          @else
              <td class="text-danger">Belum</td>
              <td class="action">
                  <a href="{{route('confirmbarangkeluar',$barangkeluar['id'])}}" class="btn btn-secondary">Konfirmasi</a>
              </td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspagebarangkeluar')}}" method="post">
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
        <form action="{{route('gotopagebarangkeluar')}}" method="post">
          @csrf
          <input type="hidden" name="link" value="{{$data['data']['links'][$i]['url']}}">
          <button type="submit" class="bg-transparent">{{$i}}</button>
        </form>
      @endfor
    </div>
    @endif
    <form action="{{route('nextpagebarangkeluar')}}" method="post">
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
@endsection
