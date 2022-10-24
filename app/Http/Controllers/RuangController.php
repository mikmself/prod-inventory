<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class RuangController extends Controller
{
    public function index()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/ruang" . $this->getToken());
        return view('dashboard.master.ruang.index',compact('data'));
    }
    public function create()
    {
        return view('dashboard.master.ruang.add');
    }
    public function store(Request $request)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/ruang/store".$this->getToken(),$request->all());
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
        ])->get($this->api."/ruang/show/". $id . $this->getToken());
        return view('dashboard.master.ruang.edit',compact('data'));
    }
    public function update(Request $request, $id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/ruang/update/".$id.$this->getToken(),$request->all());
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
        ])->delete($this->api."/ruang/destroy/".$id.$this->getToken());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
}
