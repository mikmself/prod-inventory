<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LevelCheck
{
    public function handle(Request $request, Closure $next)
    {
        $level = Session::get('level');
        if($level == "admin"){
            return $next($request);
        }else{
            return redirect('/operasi/barangkeluar');
        }
    }
}
