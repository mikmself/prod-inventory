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
    <table class="table table-striped">
      <thead>
        <tr>
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
            <td class="margin-left">{{$barang['id']}}</td>
            <td>{{$barang['nama']}}</td>
            <td>{{$barang['kategori']['nama_kategori']}}</td>
            <td>{{$barang['stok']}}</td>
            <td>{{$barang['satuan']}}</td>
            <td>{{ \Carbon\Carbon::parse($barang['updated_at'])->diffForHumans()}}</td>
            <td class="action">
                <a href="{{route('editbarang',$barang['id'])}}" class="btn btn-warning">Ubah</a>
                <a href="{{route('deletebarang',$barang['id'])}}" onclick="return confirm('Apakah anda benar-benar akan menghapusnya?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
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
