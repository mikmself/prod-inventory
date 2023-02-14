@extends('feuser.master')
@section('title','Barang Modal Keluar')
@section('content')
<section id="tambah">
    <div class="left">
        <div class="top">
            <p class="title">Tentukan Jenis Barang</p>
            <p class="desc">Contoh : kursi, meja, proyektor, dsb.</p>
            <select id="selectbarang" name="id_barang" required>
                <option ></option>
                @foreach ($databarang as $barang)
                    <option value="{{$barang['id']}}">{{$barang['nama']}}</option>
                @endforeach
            </select>
        </div>
        <div class="bottom">
            <p class="title">Pilih Barang</p>
            <p class="desc">Pilih barang dengan kode barang yang tersedia</p>
            <div class="items" id="itemsbarangfisik">

            </div>
        </div>
    </div>
    <div class="right" id="rightmenu">
        <div class="top">
            <p class="titleright">Barang Terpilih</p>
            <div class="wrapper">
                <div class="items" id="itemterpilih">

                </div>
            </div>
        </div>
        <div class="bottom">
            <form action="{{route('barangmodalkeluarnonauth')}}" id="formtambah" method="POST">
                @csrf
                <div class="form-group">
                    <label>Waktu Pengambilan</label>
                    <input type="datetime-local" name="tanggal_keluar" id="" value="{{\Carbon\Carbon::now()}}" required>
                </div>
                <div class="form-group">
                    <label>Ruang Penempatan</label>
                    <select id="selectruang" name="id_ruang" required>
                        <option ></option>
                        @foreach ($ruang['data'] as $ruang)
                            <option value="{{$ruang['id']}}">{{$ruang['nama']}}</option>
                        @endforeach
                    </select>
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
                <button type="submit">Submit Barang</button>
            </form>
        </div>
    </div>
</section>
@endsection
