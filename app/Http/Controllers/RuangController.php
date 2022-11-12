<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

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
        ])->post($this->api."/ruang/search".$this->getToken(),$request->all());
        if($data['code'] == 1){
            return view('dashboard.master.ruang.index',compact('data'));
        }else{
            toast('data tidak ditemukan','warning');
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
        ])->delete($this->api."/ruang/destroy/".$id.$this->getToken());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return redirect(route('indexruang'));
        }else{
            toast($data['message'],'error');
            return redirect(route('indexruang'));
        }
    }

    public function previouspage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.ruang.index',compact('data'));
    }
    public function nextpage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.ruang.index',compact('data'));
    }
}
