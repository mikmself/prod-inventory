<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/user" . $this->getToken());
        return view('dashboard.master.user.index',compact('data'));
    }
    public function create()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/unitkerja" . $this->getToken());
        return view('dashboard.master.user.add',compact('data'));
    }
    public function store(Request $request)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/user/store".$this->getToken(),$request->all());
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
        ])->post($this->api."/user/search".$this->getToken(),$request->all());
        // dd($data['data']);
        if($data['code'] == 1){
            return view('dashboard.master.user.index',compact('data'));
        }else{
            Alert::error('Operasi Gagal', 'Data tidak ditemukan');
            return back();
        }
    }
    public function edit($id)
    {
        $unitkerja = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/unitkerja" . $this->getToken());
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/user/show/". $id . $this->getToken());
        return view('dashboard.master.user.edit',compact('data','unitkerja'));
    }
    public function update(Request $request, $id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/user/update/".$id.$this->getToken(),$request->all());
        Session::put('firstname',$data['data']['firstname']);
        Session::put('lastname',$data['data']['lastname']);
        Session::put('email',$data['data']['email']);
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
        ])->delete($this->api."/user/destroy/".$id.$this->getToken());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return redirect(route('indexuser'));
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return redirect(route('indexuser'));
        }
    }
    public function importexcel(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|file'
        ]);
        if($validator->fails()){
            Alert::error('Operasi Gagal', $validator->errors());
            return back();
        }else{
            $path1 = $request->file('file')->store('temp');
            $path=storage_path('app').'/'.$path1;
            Excel::import(new UserImport, $path);
            Alert::success('Operasi Sukses', 'data berhasil di import');
            return back();
        }
    }
    public function exportexcel(){
        return Excel::download(new UserExport, 'userexport.xlsx');
    }
    public function downloadexcel(){
        $file= public_path(). "/excel/formatuser.xlsx";
        return response()->download($file);
    }

    public function previouspage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.user.index',compact('data'));
    }
    public function gotopage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.user.index',compact('data'));
    }
    public function nextpage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.user.index',compact('data'));
    }
}
