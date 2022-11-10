@extends('layouts/contentNavbarLayout')

@section('title', 'Edit User')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User/</span> Edit Data</h4>

<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('updateuser',$data['data']['id'])}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="firstname">First Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="firstname" name="firstname" value="{{$data['data']['firstname']}}" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="lastname">Last Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="lastname" name="lastname" value="{{$data['data']['lastname']}}" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="selectunitkerja">Unit Kerja</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectunitkerja" name="id_unitkerja" required>
                <option ></option>
                @foreach ($unitkerja['data']['data'] as $unitkerja)
                    <option value="{{$unitkerja['id']}}" {{$unitkerja['id'] == $data['data']['id_unitkerja'] ? 'selected' : ''}}>{{$unitkerja['nama']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="nip">NIP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nip" name="nip" value="{{$data['data']['nip']}}" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="email">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" value="{{$data['data']['email']}}" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="notelp">No Telephone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="notelp" name="notelp" value="{{$data['data']['notelp']}}" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="level">Level</label>
            <div class="col-sm-10">
              <select name="level" id="level" class="form-control">
                <option value="user" {{$data['data']['level'] == 'user' ? 'selected' : ''}} class="form-control">User</option>
                <option value="admin" {{$data['data']['level'] == 'admin' ? 'selected' : ''}} class="form-control">Admin</option>
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
