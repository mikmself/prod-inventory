@extends('layouts/contentNavbarLayout')
@section('title', 'Unit Kerja')
@section('content')
<!-- Striped Rows -->
<div class="card">

  <h5 class="card-header d-flex justify-content-between align-items-center">
    Unit Kerja
    <a href="{{route('createunitkerja')}}" class="btn btn-primary">Tambah Data</a>
</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID Unit Kerja</th>
          <th>Nama Unit Kerja</th>
          <th>Update Terakhir</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data['data']['data'] as $unitkerja)
        <tr>
            <td class="margin-left">{{$unitkerja['id']}}</td>
            <td>{{$unitkerja['nama']}}</td>
            <td>{{ \Carbon\Carbon::parse($unitkerja['updated_at'])->diffForHumans()}}</td>
            <td class="action">
                <a href="{{route('editunitkerja',$unitkerja['id'])}}" class="btn btn-warning">Edit</a>
                <a href="{{route('deleteunitkerja',$unitkerja['id'])}}" onclick="return confirm('Apakah anda benar-benar akan menghapusnya?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspageunitkerja')}}" method="post">
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
        @if ($data['data']['links'][$i]['url'] == null)
          
        @else
        <form action="{{route('gotopageunitkerja')}}" method="post">
          @csrf
          <input type="hidden" name="link" value="{{$data['data']['links'][$i]['url']}}">
          <button type="submit" class="bg-transparent border-transparent">{{$i}}</button>
        </form>
        @endif
      @endfor
    </div>
    @endif
    <form action="{{route('nextpageunitkerja')}}" method="post">
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
