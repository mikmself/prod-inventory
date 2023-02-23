<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Detail Barang {{ $data['data']['barangfisik']['kode'] }}</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="m-4">
    <div class="card" style="90%">
        <div class="card-body">
            <h5 class="card-title">{{ $data['data']['barang']['nama'] }}</h5>
          <p class="card-text">Satuan : {{ $data['data']['barang']['satuan'] }}</p>
            <p class="card-text">Kode Barang : {{ $data['data']['barangfisik']['kode'] }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Sumber Dana : {{ $data['data']['barangfisik']['sumber_dana'] }}</li>
            <li class="list-group-item">Tanggal Keluar : {{ $data['data']['tanggal_keluar'] }}</li>
            <li class="list-group-item">Ruang : {{ $data['data']['ruang']['nama'] }}</li>
            <li class="list-group-item">Oleh Unit Kerja : {{ $data['data']['unitkerja']['nama'] }}</li>
        </ul>
    </div>
</div>
</body>
</html>