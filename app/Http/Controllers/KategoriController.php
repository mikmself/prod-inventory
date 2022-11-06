<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/kategori" . $this->getToken());
        return view('dashboard.master.kategori.index',compact('data'));
    }
    public function create()
    {
        return view('dashboard.master.kategori.add');
    }
    public function store(Request $request)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/kategori/store".$this->getToken(),$request->all());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function edit($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/kategori/show/". $id . $this->getToken());
        return view('dashboard.master.kategori.edit',compact('data'));
    }
    public function update(Request $request, $id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/kategori/update/".$id.$this->getToken(),$request->all());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function destroy($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->delete($this->api."/kategori/destroy/".$id.$this->getToken());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }

    public function previouspage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.kategori.index',compact('data'));
    }
    public function gotopage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.kategori.index',compact('data'));
    }
    public function nextpage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.kategori.index',compact('data'));
    }
}
