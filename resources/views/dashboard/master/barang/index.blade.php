@extends('layouts/contentNavbarLayout')
@section('title', 'Barang')
@section('content')
<div class="card">
  <h5 class="card-header d-flex justify-content-between align-items-center">
    Barang
    <div>
      <a href="{{route('exportexcel')}}" class="btn btn-secondary">Export Data</a>
      <a href="{{route('createbarang')}}" class="btn btn-primary">Tambah Data</a>
    </div>
  </h5>
  <form class="d-flex m-3">
      <input type="radio" name="barangmodal" id="semuabarang" style="margin-left: .25cm" checked>
      <label for="semuabarang">Semua Barang </label>
      <input type="radio" name="barangmodal" id="baranghabispakai" style="margin-left: .25cm" value="2">
      <label for="baranghabispakai">Barang Habis Pakai </label>
      <input type="radio" name="barangmodal" id="barangmodal" style="margin-left: .25cm" value="1">
      <label for="barangmodal">Barang Modal</label>
  </form>
  <div class="table-responsive text-nowrap">
    <form action="{{ route('multipledeletebarang') }}" method="POST">
      @csrf
      <table class="table table-striped">
        <thead>
          <tr>
            <th></th>
            <th class="margin-left">ID Barang</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Update Terakhir</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0" id="semuadatabarang">
          @foreach ($data['data']['data'] as $barang)
          <tr>
              <td><input type="checkbox" name="arrayId[]" value="{{ $barang['id'] }}" class="form-check-input"></td>
              <td class="margin-left">{{$barang['id']}}</td>
              <td>{{$barang['nama']}}</td>
              <td>{{$barang['kategori']['nama_kategori']}}</td>
              <td>{{$barang['stok']}}</td>
              <td>{{$barang['satuan']}}</td>
              <td>{{ \Carbon\Carbon::parse($barang['updated_at'])->diffForHumans()}}</td>
              <td class="action">
                  @if ($barang['id_kategori'] == 1 && $barang['stok'] > 0)
                      <div class="modal fade" id="modalBarang{{ $barang['id'] }}" tabindex="-1" aria-labelledby="modalBarang{{ $barang['id'] }}" aria-hidden="true">
                        <form action="{{ route('printBarcode',$barang['id']) }}" method="post">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalBarang{{ $barang['id'] }}">Cetak Barcode</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
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
                      <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                          data-bs-target="#modalBarang{{ $barang['id'] }}">
                          Cetak Laporan
                      </button>
                  @endif
                  <a href="{{route('editbarang',$barang['id'])}}" class="btn btn-warning">Ubah</a>
                  <a href="{{route('deletebarang',$barang['id'])}}" onclick="return confirm('Apakah anda benar-benar akan menghapusnya?')" class="btn btn-danger">Hapus</a>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <button class="btn btn-danger m-4">Multiple Delete</button>
    </form>
  </div>
  <div class="card-footer text-center d-flex justify-content-between align-items-center">
    <form action="{{route('previouspagebarang')}}" method="post">
      @csrf
      <input type="hidden" name="link" value="{{$data['data']['prev_page_url']}}">
      @if ($data['data']['prev_page_url'] == null)
        <button class="btn btn-dark pull-left visually-hidden" type="submit">Previous</button>
      @else
        <button class="btn btn-dark pull-left" type="submit">Previous</button>
      @endif
    </form>

    <form action="{{route('nextpagebarang')}}" method="post">
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
<script type="text/javascript">
try {
    // Checkbox Kategori
    let arraycb = [
        document.getElementById('semuabarang'),
        document.getElementById('baranghabispakai'),
        document.getElementById('barangmodal')
    ]
    arraycb.forEach(element => {
        element.addEventListener("change",()=>{
            if(arraycb[1].checked){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type : 'POST',
                    url : '/admin/dashboard/master/barang/getbarangwithkagetgori',
                    data : 'idkategori='+arraycb[1].value,
                    success : function(response){
                        $('#semuadatabarang').html(response);
                    }
                })
            }else if(arraycb[2].checked){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type : 'POST',
                    url : '/admin/dashboard/master/barang/getbarangwithkagetgori',
                    data : 'idkategori='+arraycb[2].value,
                    success : function(response){
                        $('#semuadatabarang').html(response);
                    }
                })
            }else{
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type : 'GET',
                    url : '/admin/dashboard/master/barang/getallbarang',
                    data : [],
                    success : function(response){
                        $('#semuadatabarang').html(response);
                    }
                })
            }
        })
    });
} catch (error) {

}
</script>
@endsection
