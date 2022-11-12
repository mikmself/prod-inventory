<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

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
        ])->post($this->api."/user/search".$this->getToken(),$request->all());
        if($data['code'] == 1){
            return view('dashboard.master.user.index',compact('data'));
        }else{
            toast('data tidak ditemukan','warning');
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
        ])->delete($this->api."/user/destroy/".$id.$this->getToken());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return redirect(route('indexuser'));
        }else{
            toast($data['message'],'error');
            return redirect(route('indexuser'));
        }
    }
    public function importexcel(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|file'
        ]);
        if($validator->fails()){
            toast('data yang diinputkan tidak sesuai!','error');
            return back();
        }else{
            $path1 = $request->file('file')->store('temp');
            $path=storage_path('app').'/'.$path1;
            Excel::import(new UserImport, $path);
            toast('data berhasil di import','success');
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
    public function nextpage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.user.index',compact('data'));
    }
}
