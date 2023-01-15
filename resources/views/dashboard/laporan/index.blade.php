@extends('layouts/contentNavbarLayout')
@section('title', 'Laporan')
@section('content')
    <!-- Modal barang masuk-->
    <div class="modal fade" id="modalBarangMasuk" tabindex="-1" aria-labelledby="modalBarangMasuk" aria-hidden="true">
        <form action="{{ route('exportBarangMasuk') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBarangMasuk">Laporan Barang Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="nama" class="pt-3 pb-1">Nama</label>
                        <select class="form-control" name="nama">
                            @foreach ($barang as $satuan)
                                <option>{{ $satuan['nama'] }}</option>                                
                            @endforeach
                        </select>
                        <label for="start" class="pt-3 pb-1">Start</label>
                        <input type="date" name="start" id="start" class="form-control">
                        <label for="end" class="pt-3 pb-1">End</label>
                        <input type="date" name="end" id="end" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal barang keluar-->
    <div class="modal fade" id="modalBarangKeluar" tabindex="-1" aria-labelledby="modalBarangKeluar" aria-hidden="true">
        <form action="{{ route('exportBarangKeluar') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBarangKeluar">Laporan Barang Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="nama" class="pt-3 pb-1">Nama</label>
                        <select class="form-control" name="nama">
                            @foreach ($barangHabisPakai as $satuan)
                                <option>{{ $satuan['nama'] }}</option>                                
                            @endforeach
                        </select>
                        <label for="start" class="pt-3 pb-1">Start</label>
                        <input type="date" name="start" id="start" class="form-control">
                        <label for="end" class="pt-3 pb-1">End</label>
                        <input type="date" name="end" id="end" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal barang modal keluar-->
    <div class="modal fade" id="modalBarangModalKeluar" tabindex="-1" aria-labelledby="modalBarangModalKeluar" aria-hidden="true">
        <form action="{{ route('exportBarangModalKeluar') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBarangModalKeluar">Laporan Barang Modal Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="nama" class="pt-3 pb-1">Nama</label>
                        <select class="form-control" name="nama">
                            @foreach ($barangModal as $satuan)
                                <option>{{ $satuan['nama'] }}</option>                                
                            @endforeach
                        </select>
                        <label for="start" class="pt-3 pb-1">Start</label>
                        <input type="date" name="start" id="start" class="form-control">
                        <label for="end" class="pt-3 pb-1">End</label>
                        <input type="date" name="end" id="end" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal barang modal pinjam-->
    <div class="modal fade" id="modalBarangModalPinjam" tabindex="-1" aria-labelledby="modalBarangModalPinjam" aria-hidden="true">
        <form action="{{ route('exportBarangModalPinjam') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBarangModalPinjam">Laporan Barang Modal Pinjam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="nama" class="pt-3 pb-1">Nama</label>
                        <select class="form-control" name="nama">
                            @foreach ($barangModal as $satuan)
                                <option>{{ $satuan['nama'] }}</option>                                
                            @endforeach
                        </select>
                        <label for="start" class="pt-3 pb-1">Start</label>
                        <input type="date" name="start" id="start" class="form-control">
                        <label for="end" class="pt-3 pb-1">End</label>
                        <input type="date" name="end" id="end" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal barang modal kembali-->
    <div class="modal fade" id="modalBarangModalKembali" tabindex="-1" aria-labelledby="modalBarangModalKembali" aria-hidden="true">
        <form action="{{ route('exportBarangModalKembali') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBarangModalKembali">Laporan Barang Modal Kembali</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="nama" class="pt-3 pb-1">Nama</label>
                        <select class="form-control" name="nama">
                            @foreach ($barangModal as $satuan)
                                <option>{{ $satuan['nama'] }}</option>                                
                            @endforeach
                        </select>
                        <label for="start" class="pt-3 pb-1">Start</label>
                        <input type="date" name="start" id="start" class="form-control">
                        <label for="end" class="pt-3 pb-1">End</label>
                        <input type="date" name="end" id="end" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Transaksi</th>
                        <th>Jenis Barang</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>1</td>
                        <td>Barang Masuk</td>
                        <td>Barang Modal & Habis Pakai</td>
                        <td>
                            <!-- Button trigger modal barang masuk -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalBarangMasuk">
                                Cetak Laporan
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Barang Keluar</td>
                        <td>Barang Habis Pakai</td>
                        <td>
                            <!-- Button trigger modal barang keluar -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalBarangKeluar">
                                Cetak Laporan
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Barang Modal Keluar</td>
                        <td>Barang Modal</td>
                        <td>
                            <!-- Button trigger modal barang modal keluar -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalBarangModalKeluar">
                                Cetak Laporan
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Barang Modal Pinjam</td>
                        <td>Barang Modal</td>
                        <td>
                            <!-- Button trigger modal barang modal pinjam -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalBarangModalPinjam">
                                Cetak Laporan
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Barang Modal Kembali</td>
                        <td>Barang Modal</td>
                        <td>
                            <!-- Button trigger modal barang modal kembali -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalBarangModalKembali">
                                Cetak Laporan
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center d-flex justify-content-between align-items-center">

        </div>
    </div>
@endsection
