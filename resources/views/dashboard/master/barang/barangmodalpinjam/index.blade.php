@extends('layouts/contentNavbarLayout')
@section('title', 'Barang Modal Pinjam')
@section('content')
<div class="card">
  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang Modal Pinjam
    <a href="{{route('addbarangmodalpinjam')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="margin-left">ID</th>
          <th>Unit Kerja</th>
          <th>Barang</th>
          <th>Barang Fisik</th>
          <th>Tanggal Keluar</th>
          <th>Kegunaan</th>
          <th>Tanggal Kembali</th>
          <th>Konfirmasi</th>
          <th>Tombol Konfirmasi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data']['data'] as $barangmodalpinjam)
        <tr>
            <td class="margin-left">{{$barangmodalpinjam['id']}}</td>
            <td>{{$barangmodalpinjam['unitkerja']['nama']}}</td>
            <td>{{$barangmodalpinjam['barang']['nama']}}</td>
            <td>{{$barangmodalpinjam['barangfisik']['kode']}}</td>
            <td>{{ \Carbon\Carbon::parse($barangmodalpinjam['tanggal_keluar'])->isoFormat('dddd, D MMMM Y')}}</td>
            <td>{{$barangmodalpinjam['kegunaan']}}</td>
            <td>{{ \Carbon\Carbon::parse($barangmodalpinjam['tanggal_kembali'])->isoFormat('dddd, D MMMM Y')}}</td>
            @if ($barangmodalpinjam['confirm'] == 1)
                <td class="text-success">Ya</td>
            @else
                <td class="text-danger">Belum</td>
                <td class="action">
                    <a href="{{route('confirmbarangmodalpinjam',$barangmodalpinjam['id_barang'])}}" class="btn btn-secondary">Konfirmasi</a>
                </td>
            @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspagebarangmodalpinjam')}}" method="post">
      @csrf
      <input type="hidden" name="link" value="{{$data['data']['prev_page_url']}}">
      @if ($data['data']['prev_page_url'] == null)
        <button class="btn btn-dark pull-left visually-hidden" type="submit">Previous</button>
      @else
        <button class="btn btn-dark pull-left" type="submit">Previous</button>
      @endif
    </form>
   
    <form action="{{route('nextpagebarangmodalpinjam')}}" method="post">
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
