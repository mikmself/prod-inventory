@extends('layouts/contentNavbarLayout')
@section('title', 'Barang Masuk')
@section('content')
<div class="card">
  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang Masuk
    <a href="{{route('addbarangmasuk')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
            <th class="margin-left">ID</th>
            <th>Barang</th>
            <th>Suplayer</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Tanggal Masuk</th>
            <th>Pemesan</th>
            <th>Penerima</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data']['data'] as $barangmasuk)
        <tr>
            <td class="margin-left">{{$barangmasuk['id']}}</td>
            <td>{{$barangmasuk['barang']['nama']}}</td>
            <td>{{$barangmasuk['suplayer']['nama']}}</td>
            <td>{{$barangmasuk['kategori']['nama_kategori']}}</td>
            <td>{{$barangmasuk['jumlah']}}</td>
            <td>{{ \Carbon\Carbon::parse($barangmasuk['tanggal_masuk'])->isoFormat('dddd, D MMMM Y')}}</td>
            <td>{{$barangmasuk['pemesan']}}</td>
            <td>{{$barangmasuk['penerima']}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspagebarangmasuk')}}" method="post">
      @csrf
      <input type="hidden" name="link" value="{{$data['data']['prev_page_url']}}">
      @if ($data['data']['prev_page_url'] == null)
        <button class="btn btn-dark pull-left visually-hidden" type="submit">Previous</button>
      @else
        <button class="btn btn-dark pull-left" type="submit">Previous</button>
      @endif
    </form>
    
    <form action="{{route('nextpagebarangmasuk')}}" method="post">
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
