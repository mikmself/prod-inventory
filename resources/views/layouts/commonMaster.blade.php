<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title') | Bpinv </title>
  <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Canonical SEO -->
  <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .form-control {

}
    .select2-selection__rendered {
      line-height: 40px !important;
    }
    .select2-container .select2-selection--single {
        height: 40px !important;
        border: 1px solid #d9dee3;
        color: #697a8d;
    }
    .select2-selection__arrow {
        height: 40px !important;
        border: 1px solid #d9dee3;
        color: #697a8d;
    }
  </style>
  <!-- Include Styles -->
  @include('layouts/sections/styles')

  <!-- Include Scripts for customizer, helper, analytics, config -->
  @include('layouts/sections/scriptsIncludes')
</head>

<body>
  @include('sweetalert::alert')
  <!-- Layout Content -->
  @yield('layoutContent')
  <!--/ Layout Content -->


  <!-- Include Scripts -->
  @include('layouts/sections/scripts')

</body>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$("#selectuser").select2();
$("#selectruang").select2();
$("#selectbarang").select2();
$("#selectbarangfisik").select2();
$("#selectsuplayer").select2();
$("#selectkategori").select2();
$("#selectunitkerja").select2();

// Select kategori
try {
    // Select 2 barang on change
    $("#selectkategori").on("change",function(e){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'POST',
            url : '/admin/dashboard/master/barang/getbarangsesuaikategori',
            data : 'idkategori='+this.value,
            success : function(response){
                $('#selectbarang').html(response);
            }
        })
    });
} catch (error) {
    console.log("select kategori tidak diperlukan");
}
</script>
</html>
