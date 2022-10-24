@foreach ($databarang as $data)
  <tr>
      <td class="margin-left">{{$data['id']}}</td>
      <td>{{$data['nama']}}</td>
      <td>{{$data['kategori']['nama_kategori']}}</td>
      <td>{{$data['stok']}}</td>
      <td>{{$data['satuan']}}</td>
      <td>{{ \Carbon\Carbon::parse($data['updated_at'])->diffForHumans()}}</td>
      <td class="action">
          <a href="{{route('editbarang',$data['id'])}}" class="btn btn-warning">Ubah</a>
          <a href="{{route('deletebarang',$data['id'])}}" onclick="return confirm('Apakah anda benar-benar akan menghapusnya?')" class="btn btn-danger">Hapus</a>
      </td>
  </tr>
@endforeach
