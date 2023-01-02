@extends('feuser.master')
@section('title','Barang Keluar')
@section('content')
<style>
    .disabled-item{
        background-color: rgb(226, 226, 226) !important;
    }
</style>
<section id="tambah2">
    <div class="left">
        <input type="search" id="searchbarang" placeholder="Search barang" style="
            width: 5cm;
            height: .8cm;
            border-radius: 5px;
            background: transparent;
            margin-bottom: .5cm;
            border: 2px solid black;
            color: black;
            padding-left: .2cm;
            margin-top : .5cm;
            margin-left:.5cm;
        ">
        <div class="bottom">
            <p class="title">Pilih Barang</p>
            <p class="desc">Pilih barang dengan kode barang yang tersedia</p>
            <div class="items habispakai" id="databarang">

            </div>
        </div>
    </div>
    <div class="right" id="rightmenu">
        <div class="top">
            <p class="titleright">Barang Terpilih</p>
            <div class="wrapper">
                <div class="items" id="bhpterpilih">

                </div>
            </div>
        </div>
        <div class="bottom">
            <form action="{{route('barangkeluarnonauth')}}" id="formtambahbhp" method="POST">
                @csrf
                <div class="form-group">
                    <label>Tanggal Keluar</label>
                    <input type="datetime-local" name="tanggal_keluar" id="" value="{{\Carbon\Carbon::now()}}" required/>
                </div>
                <div class="form-group">
                    <label>Unit Kerja</label>
                    <select id="selectuser" name="id_unitkerja" required>
                        <option ></option>
                        @foreach ($unitkerja['data'] as $unitkerja)
                            <option value="{{$unitkerja['id']}}" {{$unitkerja['id'] == old('id_unitkerja') ? 'selected' : ''}}>{{$unitkerja['nama']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Kegunaan</label>
                    <input type="text" name="kegunaan" id="" value="{{old('kegunaan', '')}}" required/>
                </div>
                <button type="submit">Submit Barang</button>
            </form>
        </div>
    </div>
</section>
@endsection
