@extends('layouts/contentNavbarLayout')
@section('title', 'Barang Modal Keluar')
@section('content')
<div class="card">
  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang Modal Keluar
    <a href="{{route('addbarangmodalkeluar')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="margin-left">ID</th>
          <th>User</th>
          <th>Barang</th>
          <th>Barang Fisik</th>
          <th>Tanggal Keluar</th>
          <th>Ruang</th>
          <th>Konfirmasi</th>
          <th>Tombol Konfirmasi</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data']['data'] as $barangmodalkeluar)
        <tr>
          <td class="margin-left">{{$barangmodalkeluar['id']}}</td>
          <td>{{$barangmodalkeluar['user']['firstname'] . " " . $barangmodalkeluar['user']['lastname']}}</td>
          <td>{{$barangmodalkeluar['barang']['nama']}}</td>
          <td>{{$barangmodalkeluar['barangfisik']['kode']}}</td>
          <td>{{ \Carbon\Carbon::parse($barangmodalkeluar['tanggal_keluar'])->isoFormat('dddd, D MMMM Y')}}</td>
          <td>{{$barangmodalkeluar['ruang']['nama']}}</td>
          @if ($barangmodalkeluar['confirm'] == 1)
              <td class="text-success">Ya</td>
          @else
              <td class="text-danger">Belum</td>
              <td class="action">
                  <a href="{{route('confirmbarangmodalkeluar',$barangmodalkeluar['id_barang'])}}" class="btn btn-secondary">Konfirmasi</a>
              </td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspagebarangmodalkeluar')}}" method="post">
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
        <form action="{{route('gotopagebarangmodalkeluar')}}" method="post">
          @csrf
          <input type="hidden" name="link" value="{{$data['data']['links'][$i]['url']}}">
          <button type="submit" class="bg-transparent">{{$i}}</button>
        </form>
      @endfor
    </div>
    @endif
    <form action="{{route('nextpagebarangmodalkeluar')}}" method="post">
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
