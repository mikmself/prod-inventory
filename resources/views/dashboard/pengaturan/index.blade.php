@extends('layouts/contentNavbarLayout')

@section('title', ' Pengaturan')

@section('content')
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Pengatuaran</h5> <small class="text-muted float-end"> </small>
      </div>
      <div class="card-body">
        <form action="{{route('updatepengaturandashboard',$user['id'])}}" method="POST">
          @csrf
          <div class="mb-3">
            <label class="form-label" for="firstname">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{$user['firstname']}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="lastname">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{$user['lastname']}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="level">Level</label>
            <input type="text" class="form-control" id="level" name="level" value="{{$user['level']}}" readonly />
          </div>
          <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{$user['email']}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="notelp">No Telephone</label>
            <input type="text" class="form-control" id="notelp" name="notelp" value="{{$user['notelp']}}"/>
          </div>
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
  </div>
@endsection
