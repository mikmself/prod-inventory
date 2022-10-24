@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah User')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User/</span> Tambah Data</h4>

<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('storeuser')}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="firstname">First Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="firstname" name="firstname" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="lastname">Last Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="lastname" name="lastname" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="email">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="notelp">No Telephone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="notelp" name="notelp" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="level">Level</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="level" name="level" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="password">Password</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="password" name="password" required/>
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
