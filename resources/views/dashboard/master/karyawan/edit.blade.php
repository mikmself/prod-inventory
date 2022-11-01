@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Karyawan')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Karyawan/</span> Edit Data</h4>

<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('updatekaryawan',$data['data']['id'])}}" method="POST">
          @csrf
          <input type="hidden" name="id_user" value="{{$data['data']['id_user']}}">
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="nama">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" name="nama" value="{{$data['data']['nama']}}" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="selectunitkerja">Unit Kerja</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectunitkerja" name="id_unitkerja" required>
                <option ></option>
                @foreach ($unitkerja['data'] as $unitkerja)
                    <option value="{{$unitkerja['id']}}" {{$unitkerja['id'] == $data['data']['id_unitkerja'] ? 'selected' : ''}}>{{$unitkerja['nama']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
