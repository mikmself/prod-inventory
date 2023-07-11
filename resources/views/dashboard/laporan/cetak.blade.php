<html>
<head>
    <title>Template Laporan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            width: 100%;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            align-items: center;
        }

        header {
            width: 85%;
        }
        header h1 {
            margin-top: 1cm;
            text-align: center;
        }
        header table {
            margin-top: 1cm;
        }
        header table tr th {
            padding-right: 0.5cm;
            font-size: 16px;
            text-align: left;
        }

        main {
            width: 85%;
        }
        main table, main td, main th {
            border: 1px solid;
        }
        main table {
            width: 100%;
            margin-top: 1cm;
            border-collapse: collapse;
        }
        main table td, main table th {
            padding: 0.2cm;
        }
        footer {
            margin-top: 2cm;
            width: 100%;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            align-items: center;
        }
        footer table {
            text-align: center;
        }
        footer table tr.ttd {
            height: 2cm;
        }
        footer .container {
            width: 80%;
            margin-top: 1cm;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>BON BARANG HABIS PAKAI</h1>
        <div class="container">
            <table>
                <tr>
                    <th>NOMOR</th>
                    <th>:</th>
                    <td></td>
                </tr>
                <tr>
                    <th>TANGGAL</th>
                    <th>:</th>
                    <td>{{Carbon\Carbon::now()->isoFormat('D MMMM Y');}}</td>
                </tr>
                <tr>
                    <th>BIDANG</th>
                    <th>:</th>
                    <td>{{$barangkeluar['message']}}</td>
                </tr>
            </table>
        </div>
    </header>
    <main>
        <table>
            <tr>
                <th>NO</th>
                <th>NAMA BARANG</th>
                <th>JUMLAH</th>
                <th>SATUAN</th>
            </tr>
            @php
                $i = 1;
            @endphp
            @foreach ( $barangkeluar['data'] as $barang)                
            <tr>
                <td>{{$i}}</td>
                <td>{{$barang['barang']['nama']}}</td>
                <td>{{$barang['jumlah']}}</td>
                <td>{{$barang['barang']['satuan']}}</td>
            </tr>
            @php
                $i++;
            @endphp
            @endforeach
        </table>
    </main>
    <footer>
        <table>
            <tr>
                <th>Plt. KEPALA TATA USAHA</th>
            </tr>
            <tr class="ttd">
                <td></td>
            </tr>
            <tr>
                <td><b>SUKIRMAN, S.Pd, MM</b></td>
            </tr>
            <tr>
                <td><b>NIP. 19680208 200801 1 005</b></td>
            </tr>
        </table>
        <div class="container">
            <table>
                <tr>
                    <th>YANG MENYERAHKAN</th>
                </tr>
                <tr class="ttd">
                    <td></td>
                </tr>
                <tr>
                    <td><b>ELIS SETIAWAN</b></td>
                </tr>
                <tr>
                    <td><b></b></td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>YANG MENERIMA</th>
                </tr>
                <tr class="ttd">
                    <td></td>
                </tr>
                <tr>
                    <td><b><hr></b></td>
                </tr>
                <tr>
                    <td><b>NIP</b></td>
                </tr>
            </table>
        </div>
    </footer>
</body>
</html>