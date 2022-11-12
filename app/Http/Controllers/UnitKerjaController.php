<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UnitKerjaController extends Controller
{
    public function index()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/unitkerja" . $this->getToken());
        // dd($data['data']);
        return view('dashboard.master.unitkerja.index',compact('data'));
    }
    public function create()
    {
        return view('dashboard.master.unitkerja.add');
    }
    public function store(Request $request)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/unitkerja/store".$this->getToken(),$request->all());
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
        ])->post($this->api."/unitkerja/search".$this->getToken(),$request->all());
        if($data['code'] == 1){
            return view('dashboard.master.unitkerja.index',compact('data'));
        }else{
            toast('data tidak ditemukan','warning');
            return back();
        }
    }
    public function edit($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/unitkerja/show/". $id . $this->getToken());
        return view('dashboard.master.unitkerja.edit',compact('data'));
    }
    public function update(Request $request, $id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/unitkerja/update/".$id.$this->getToken(),$request->all());
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
        ])->delete($this->api."/unitkerja/destroy/".$id.$this->getToken());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return redirect(route('indexunitkerja'));
        }else{
            toast($data['message'],'error');
            return redirect(route('indexunitkerja'));
        }
    }

    public function previouspage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.unitkerja.index',compact('data'));
    }
    public function nextpage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.unitkerja.index',compact('data'));
    }
}
