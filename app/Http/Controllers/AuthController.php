<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login(){
        return view('master.auth');
    }
    public function storelogin(Request $request){
        $data = Http::post($this->api."/auth/login",$request->all());
        if($data['code'] == 1){
            Session::put('firstname',$data['data']['firstname']);
            Session::put('lastname',$data['data']['lastname']);
            Session::put('unitkerja',$data['data']['unitkerja']);
            Session::put('nip',$data['data']['nip']);
            Session::put('email',$data['data']['email']);
            Session::put('token',$data['data']['token']);
            Session::put('apikey',$data['data']['access_token']);

            return redirect('admin/dashboard/');
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function logout(){
        Session::forget('fristname');
        Session::forget('lastname');
        Session::forget('email');
        Session::forget('token');
        Session::forget('apikey');

        return redirect('/login');
    }
}
