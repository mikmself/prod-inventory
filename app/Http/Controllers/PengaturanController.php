<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PengaturanController extends Controller
{
    public function index()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/pengaturan" . $this->getToken());
        return view('dashboard.master.pengaturan.index',compact('data'));
    }
    public function create()
    {
        return view('dashboard.master.pengaturan.add');
    }
    public function store(Request $request)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/pengaturan/store".$this->getToken(),$request->all());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function search(Request $request)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/pengaturan/search".$this->getToken(),$request->all());
        if($data['code'] == 1){
            return view('dashboard.master.pengaturan.index',compact('data'));
        }else{
            Alert::error('Operasi Gagal', 'Data tidak ditemukan');
            return back();
        }
    }
    public function edit($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/pengaturan/show/". $id . $this->getToken());
        if($data['data']['key'] == "logo"){
            $file = true;
            return view('dashboard.master.pengaturan.edit',compact('data','file'));
        }else{
            return view('dashboard.master.pengaturan.edit',compact('data'));
        }
    }
    public function update(Request $request, $id)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $random = Str::random(15);
            $ekstansi = $file->getClientOriginalExtension();
            $nama = $random . "." . $ekstansi;
            $file->move(public_path('/assets/images/logo'),$nama);

            $path = "/assets/images/logo/" . $nama;
            $request->request->add(['value' => $path]);
        }
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/pengaturan/update/".$id.$this->getToken(),$request->all());
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
        ])->delete($this->api."/pengaturan/destroy/".$id.$this->getToken());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return redirect(route('indexpengaturan'));
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return redirect(route('indexpengaturan'));
        }
    }

    public function previouspage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.pengaturan.index',compact('data'));
    }
    public function gotopage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.pengaturan.index',compact('data'));
    }
    public function nextpage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.pengaturan.index',compact('data'));
    }
}
