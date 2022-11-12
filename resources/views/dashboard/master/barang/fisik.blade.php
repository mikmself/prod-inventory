@extends('layouts/contentNavbarLayout')
@section('title', 'Barang Fisik')
@section('content')
<div class="card">
  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang Fisik
  </h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Barang</th>
          <th>Kode</th>
          <th>Status Pengambilan</th>
          <th>Update Terakhir</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data']['data'] as $fisik)
        <tr>
            <td>{{$fisik['barang']['nama']}}</td>
            <td>{{$fisik['kode']}}</td>
            <td>{{$fisik['status_pengambilan']}}</td>
            <td>{{ \Carbon\Carbon::parse($fisik['updated_at'])->diffForHumans()}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspagebarangfisik')}}" method="post">
      @csrf
      <input type="hidden" name="link" value="{{$data['data']['prev_page_url']}}">
      @if ($data['data']['prev_page_url'] == null)
        <button class="btn btn-dark pull-left visually-hidden" type="submit">Previous</button>
      @else
        <button class="btn btn-dark pull-left" type="submit">Previous</button>
      @endif
    </form>
    
    <form action="{{route('nextpagebarangfisik')}}" method="post">
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
