<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Print QRCode</title>
    <style>
        img {
            width: 1.5cm;
            height: 1.5cm;
        }

        .labels .label {
            width: 15cm;
            height: 4cm;
            background-color: yellow;
            border: 2px solid black;
            margin-top: 1cm;
        }
        .labels .label .header {
            width: 100%;
            height: 2cm;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 0.2cm;
            box-sizing: border-box;
            border-bottom: 5px double black;
        }
        .labels .label .header .left {
            width: 20%;
        }
        .labels .label .header .left img {
            width: 1.3cm;
            height: 1.3cm;
        }
        .labels .label .header .left img.smklogo {
            width: 1.35cm;
            height: 1.35cm;
        }
        .labels .label .header .center {
            width: 60%;
        }
        .labels .label .header .center p {
            font-size: 14px;
            text-align: center;
            line-height: 0.1cm;
        }
        .labels .label .header .center p.school {
            font-weight: bold;
            font-size: 16px;
        }
        .labels .label .header .right {
            width: 20%;
        }
        .labels .label .header .right img {
            float: right;
        }
        .labels .label .content {
            width: 100%;
            border-bottom: 2px double black;
        }
        .labels .label .content p.code {
            text-align: center;
            line-height: 0.1cm;
        }
        .labels .label .footer {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-evenly;
        }
        .labels .label .footer p {
            line-height: 0.1cm;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="labels">
        @foreach ($databarangbarang['data'] as $barang)
        <div class="label">
            <div class="header">
                <div class="left">
                    <img src="/qrcode/jateng.png" alt="Logo Provinsi Jawa Tengah" class="jatenglogo">
                    <img src="/qrcode/smkn1.png" alt="Logo SMK Negeri 1 Purwokerto" class="smklogo">
                </div>
                <div class="center">
                    <p class="province">PEMERINTAH PROVINSI JAVA TENGAH</p>
                    <p class="school">SMK Negeri 1 Purwokerto</p>
                </div>
                <div class="right">
                    {!! QrCode::size(50)->generate(route('detailbarang',$barang['barangfisik']['kode'])) !!}
                </div>
            </div>
            <div class="content">
                <p class="code">{{ $barang['barangfisik']['kode'] }}</p>
            </div>
            <div class="footer">
                <div class="left">
                    <p class="room">{{ $barang['ruang']['nama'] }}</p>
                </div>
                <div class="center">
                    <p class="item">{{ $barang['barang']['nama'] }}</p>
                </div>
                <div class="right">
                    <p class="source">{{ $barang['barangfisik']['sumber_dana'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>