@extends('feuser.master')
@section('title','Barang Keluar')
@section('content')
<section id="tambah2">
    <div class="left">
        <input type="search" id="searchbarang" placeholder="Search barang" style="
            width: 5cm;
            height: .8cm;
            border-radius: 8px;
            background: transparent;
            margin-bottom: .5cm;
            border: 2px solid black;
            color: black;
            padding-left: .2cm;
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
                    <label>Karyawan</label>
                    <select id="selectkaryawan" name="id_karyawan" required>
                        <option ></option>
                        @foreach ($karyawan['data'] as $karyawan)
                            <option value="{{$karyawan['id']}}">{{$karyawan['nama']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Kegunaan</label>
                    <input type="text" name="kegunaan" id="" required/>
                </div>
                <button type="submit">Submit Barang</button>
            </form>
        </div>
    </div>
</section>
@endsection
