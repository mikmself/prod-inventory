<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CekToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = Session::get('token');
        $apikey = Session::get('apikey');
        $api = "https://restinventory.bakaranproject.com";
        if(isset($token) && isset($apikey)){
            $data = Http::withHeaders([
                'apikey' => $apikey
            ])->get($api."/auth/cektoken?token=" . $token);
            if($data['code'] == 1){
                return $next($request);
            }else{
                Session::forget('token');
                Session::forget('apikey');
                return redirect('/login');
            }
        }else{
            return redirect('/login');
        }
    }
}
