<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
      '/admin/dashboard/master/barang/getspesifikbarangfisik',
      '/operasi/getspesifikbarangfisik',
      '/admin/dashboard/master/barang/getbarangsesuaikategori',
      'admin/dashboard/master/barang/getbarangwithkagetgori',
      'operasi/searchbarang',
      'admin/dashboard/master/barang/getinputbarangkeluar',
    ];
}
