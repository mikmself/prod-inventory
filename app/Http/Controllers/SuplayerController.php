<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

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
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'error');
            return back();
        }
    }
    public function search(Request $request)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/suplayer/search".$this->getToken(),$request->all());
        if($data['code'] == 1){
            return view('dashboard.master.suplayer.index',compact('data'));
        }else{
            toast('data tidak ditemukan','warning');
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
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'error');
            return back();
        }
    }
    public function destroy($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->delete($this->api."/suplayer/destroy/".$id.$this->getToken());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return redirect(route('indexsuplayer'));
        }else{
            toast($data['message'],'error');
            return redirect(route('indexsuplayer'));
        }
    }
    public function multipledelete(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/suplayer/multipleDelete".$this->getToken(),$request->all());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return back();
        }else{
            toast('gagal menghapus banyak barang','warning');
            return back();
        }
    }
    public function previouspage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.suplayer.index',compact('data'));
    }
    public function nextpage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.suplayer.index',compact('data'));
    }
}
