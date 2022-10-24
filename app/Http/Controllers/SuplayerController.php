<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class SuplayerController extends Controller
{
    public function index()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/suplayer" . $this->getToken());
        return view('dashboard.master.suplayer.index',compact('data'));
    }
    public function create()
    {
        return view('dashboard.master.suplayer.add');
    }
    public function store(Request $request)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/suplayer/store".$this->getToken(),$request->all());
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
        ])->get($this->api."/suplayer/show/". $id . $this->getToken());
        return view('dashboard.master.suplayer.edit',compact('data'));
    }
    public function update(Request $request, $id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/suplayer/update/".$id.$this->getToken(),$request->all());
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
        ])->delete($this->api."/suplayer/destroy/".$id.$this->getToken());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
}
