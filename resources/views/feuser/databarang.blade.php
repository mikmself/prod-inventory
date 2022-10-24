@foreach ($data as $barang)
    <div class="item" id="bhp{{$barang['id']}}">
        <img src="/assets/icons/itembarang.png" alt="" srcset="" class="img" />
        <div class="kanan">
            <p class="nama">{{$barang['nama']}}</p>
            <p class="desc"><span class="sisa">{{$barang['stok']}}</span> Tersisa</p>
        </div>
    </div>
@endforeach

