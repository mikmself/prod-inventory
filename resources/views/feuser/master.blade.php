<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/select2.css">
    <link rel="stylesheet" href="/assets/css/user.css">
    <title>@yield('title')</title>
    <style>

    </style>
</head>
<body>
    @include('sweetalert::alert')
    <main>
        <section id="content">
            <div class="extrasmenu">
                <a href="{{route('indexbarangkeluarnonauth')}}">Barang Keluar</a>
                <a href="{{route('indexbarangmodalkeluarnonauth')}}">Barang Modal Keluar</a>
                <a href="{{route('indexbarangmodalpinjamnonauth')}}">Bon Pinjam</a>
            </div>
        </section>
        @yield('content')
    </main>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="/assets/js/feuser.js"></script>
</html>
