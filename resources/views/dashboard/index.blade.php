@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="col-lg-12 col-md-4 order-1">
  <div class="row">
    <div class="row-lg-6 col-md-12 col-6 mb-4">
      <div class="card mt-3">
        <div class="card-body">
          <div class="card-title d-flex align-items-center justify-content-center">
            <span class="fw-semibold d-block mb-1">Barang Keluar Bulan Ini</span>
          </div>
          <h3 class="text-center mb-2">{{$data['data']['barang_keluar_bulanan']}}</h3>
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-body">
          <div class="card-title d-flex align-items-center justify-content-center">
            <span class="fw-semibold d-block mb-1">Barang Keluar Tahun Ini</span>
          </div>
          <h3 class="text-center mb-2">{{$data['data']['barang_keluar_tahunan']}}</h3>
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-body">
          <div class="card-title d-flex align-items-center justify-content-center">
            <span class="fw-semibold d-block mb-1">Barang Modal Keluar Bulan Ini</span>
          </div>
          <h3 class="text-center mb-2">{{$data['data']['barang_modal_keluar_bulanan']}}</h3>
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-body">
          <div class="card-title d-flex align-items-center justify-content-center">
            <span class="fw-semibold d-block mb-1">Barang Modal Keluar Tahun Ini</span>
          </div>
          <h3 class="text-center mb-2">{{$data['data']['barang_modal_keluar_tahunan']}}</h3>
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-body">
          <div class="card-title d-flex align-items-center justify-content-center">
            <span class="fw-semibold d-block mb-1">Barang Modal Pinjam Bulan Ini</span>
          </div>
          <h3 class="text-center mb-2">{{$data['data']['barang_modal_pinjam_bulanan']}}</h3>
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-body">
          <div class="card-title d-flex align-items-center justify-content-center">
            <span class="fw-semibold d-block mb-1">Barang Modal Pinjam Tahun Ini</span>
          </div>
          <h3 class="text-center mb-2">{{$data['data']['barang_modal_pinjam_tahunan']}}</h3>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
