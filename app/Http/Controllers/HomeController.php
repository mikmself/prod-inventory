<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/indexdashboard" . $this->getToken());
        return view('dashboard.index',compact('data'));
    }
    public function indexPengaturan(){
        $email = Session::get('email');
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/user" . $this->getToken());
        $collection = collect($data->json()['data']);
        $user = $collection->whereIn('email',$email)->first();
        return view('dashboard.pengaturan.index',compact('user'));
    }
    public function indexBarangKeluar(){
        $user = Http::get($this->api."/user/nonauth/indexuser");
        return view('feuser.barangkeluar',compact('user'));
    }
    public function barangKeluar(Request $request){
        $data = Http::post($this->api . "/user/nonauth/barangkeluar",$request->all());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }

    public function indexBarangModalKeluar(){
        $datamentah = Http::get($this->api."/user/nonauth/indexbarang");
        $user = Http::get($this->api."/user/nonauth/indexuser");
        $ruang = Http::get($this->api."/user/nonauth/indexruang");
        $collection = collect($datamentah->json()['data']);
        $databarang = $collection->whereIn('id_kategori',1);
        return view('feuser.barangmodalkeluar',compact('databarang','user','ruang'));
    }
    public function barangModalKeluar(Request $request){
        $data = Http::post($this->api . "/user/nonauth/barangmodalkeluar",$request->all());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }

    public function indexBarangModalPinjam(){
        $datamentah = Http::get($this->api."/user/nonauth/indexbarang");
        $user = Http::get($this->api."/user/nonauth/indexuser");
        $ruang = Http::get($this->api."/user/nonauth/indexruang");
        $collection = collect($datamentah->json()['data']);
        $databarang = $collection->whereIn('id_kategori',1);
        return view('feuser.barangmodalpinjam',compact('databarang','user','ruang'));
    }
    public function barangModalPinjam(Request $request){
        $data = Http::post($this->api . "/user/nonauth/barangmodalpinjam",$request->all());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }

    public function getSpesifikBarangFisik(Request $request){
        $idbarang = $request->idbarang;
        $data = Http::get($this->api . "/user/nonauth/indexbarangfisik");
        $collection = collect($data->json()['data']);
        $datafisik = $collection->whereIn('id_barang',$idbarang)->whereIn('status_pengambilan',0);
        foreach ($datafisik as $barangfisik) {
            echo "<p class=\"itembarang\" id=\"{$barangfisik['id']}\">{$barangfisik['kode']}</p>";
        }
    }

    public function searchBarang(Request $request){
        $nama = $request->nama;
        $databarang = Http::get($this->api . "/user/nonauth/indexbarang");
        $collection = collect($databarang->json()['data'])->whereIn('id_kategori',2);
        $data = $collection->filter(function ($item) use ($nama) {
            return false !== stripos($item['nama'], $nama);
        });
        return view('feuser.databarang',compact('data'));
    }
}
