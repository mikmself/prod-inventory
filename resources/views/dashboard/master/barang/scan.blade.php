@extends('layouts/contentNavbarLayout')
@section('title', 'Scan QRCODE')
@section('content')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"> </script>
<div style="width: 500px" id="reader"></div>
<script type="text/javascript">
function onScanSuccess(decodedText, decodedResult) {
    console.log(`Scan result: ${decodedText}`, decodedResult);
}

function onScanError(errorMessage) {
    console.log(errorMessage)
}

var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
@endsection