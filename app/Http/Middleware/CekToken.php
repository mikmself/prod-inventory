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
        // $api = "http://bpinvservice.bakaranproject.com";
        $api = "http://127.0.0.1:8000";
        if(isset($token) && isset($apikey)){
            $data = Http::withHeaders([
                'apikey' => $apikey
            ])->get($api."/cektoken/token?token=" . $token);
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
