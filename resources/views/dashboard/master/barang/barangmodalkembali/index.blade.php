@extends('layouts/contentNavbarLayout')
@section('title', 'Barang Modal Kembali')
@section('content')
<div class="card">
  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang Modal Kembali
    <a href="{{route('addbarangmodalkembali')}}" class="btn btn-primary">Acc Barang Kembali</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Barang</th>
          <th>Tanggal Kembali</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data']['data'] as $barangmodalkembali)
        <tr>
          <td class="margin-left">{{$barangmodalkembali['id']}}</td>
          <td>{{$barangmodalkembali['barang']['nama']}}</td>
          <td>{{ \Carbon\Carbon::parse($barangmodalkembali['tanggal_kembali'])->isoFormat('dddd, D MMMM Y')}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspagebarangmodalkembali')}}" method="post">
      @csrf
      <input type="hidden" name="link" value="{{$data['data']['prev_page_url']}}">
      @if ($data['data']['prev_page_url'] == null)
        <button class="btn btn-dark pull-left visually-hidden" type="submit">Previous</button>
      @else
        <button class="btn btn-dark pull-left" type="submit">Previous</button>
      @endif
    </form>
   
    <form action="{{route('nextpagebarangmodalkembali')}}" method="post">
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
