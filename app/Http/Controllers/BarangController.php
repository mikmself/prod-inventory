<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Imports\BarangImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    public function index()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang" . $this->getToken());
        return view('dashboard.master.barang.index',compact('data'));
    }
    public function indexBarangFisik(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/fisik" . $this->getToken());
        return view('dashboard.master.barang.fisik',compact('data'));
    }
    public function confirm(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/indexconfrim" . $this->getToken());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function create()
    {
        $datakategori = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/kategori" . $this->getToken());
        return view('dashboard.master.barang.add',compact('datakategori'));
    }
    public function store(Request $request)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/store".$this->getToken(),$request->all());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function indexBarangMasuk(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/indexbarangmasuk" . $this->getToken());
        return view('dashboard.master.barang.barangmasuk.index',compact('data'));
    }
    public function addBarangMasuk()
    {
        $datauser = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/user" . $this->getToken());
        $datakategori = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/kategori" . $this->getToken());
        $datasuplayer = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/suplayer" . $this->getToken());
        return view('dashboard.master.barang.barangmasuk.add',compact('datauser','datakategori','datasuplayer'));
    }
    public function barangMasuk(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/barangmasuk".$this->getToken(),$request->all());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function indexBarangKeluar(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/indexbarangkeluar" . $this->getToken());
        $datauser = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/user" . $this->getToken());
        return view('dashboard.master.barang.barangkeluar.index',compact('data','datauser'));
    }
    public function filterBarangKeluar(Request $request){
        $iduser = $request->input('id_user');
        $datauser = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/user" . $this->getToken());
        if($iduser == null){
            $data = Http::withHeaders([
                'apikey' => $this->getApiKey()
            ])->get($this->api."/barang/indexbarangkeluar" . $this->getToken());
        }else{
            $databarang = Http::withHeaders([
                'apikey' => $this->getApiKey()
            ])->get($this->api."/barang/indexbarangkeluar" . $this->getToken());
            $collection = collect($databarang->json()['data']);
            $datas = $collection->whereIn('id_user',$iduser);
            $data = [
                'data' => $datas
            ];
        }
        return view('dashboard.master.barang.barangkeluar.index',compact('data','datauser'));
    }
    public function addBarangKeluar()
    {
        $datamentahbarang = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang" . $this->getToken());
        $collection = collect($datamentahbarang->json()['data']);
        $databarang = $collection->whereIn('id_kategori',2);
        $datauser = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/user" . $this->getToken());
        return view('dashboard.master.barang.barangkeluar.add',compact('databarang','datauser'));
    }
    public function barangKeluar(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/barangkeluar".$this->getToken(),$request->all());
        if($data['code'] == 1){
            // Alert::success('Operasi Sukses', $data['message']);
            toast($data['message'],'success');
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function confirmBarangKeluar($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/confirmbarangkeluar/".$id.$this->getToken());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function indexBarangModalKeluar(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/indexbarangmodalkeluar" . $this->getToken());
        return view('dashboard.master.barang.barangmodalkeluar.index',compact('data'));
    }
    public function addBarangModalKeluar()
    {
        $datamentahbarang = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang" . $this->getToken());
        $collection = collect($datamentahbarang->json()['data']);
        $databarang = $collection->whereIn('id_kategori',1);
        $datauser = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/user" . $this->getToken());
        $dataruang = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/ruang" . $this->getToken());
        return view('dashboard.master.barang.barangmodalkeluar.add',compact('databarang','datauser','dataruang'));
    }
    public function barangModalKeluar(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/barangmodalkeluar".$this->getToken(),$request->all());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function confirmBarangModalKeluar($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/confirmbarangmodalkeluar/".$id.$this->getToken());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function indexBarangModalPinjam(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/indexbarangmodalpinjam" . $this->getToken());
        return view('dashboard.master.barang.barangmodalpinjam.index', compact('data'));
    }
    public function addBarangModalPinjam()
    {
        $datamentahbarang = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang" . $this->getToken());
        $collection = collect($datamentahbarang->json()['data']);
        $databarang = $collection->whereIn('id_kategori',1);
        $datauser = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/user" . $this->getToken());
        $dataruang = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/ruang" . $this->getToken());
        return view('dashboard.master.barang.barangmodalpinjam.add',compact('databarang','datauser','dataruang'));
    }
    public function barangModalPinjam(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/barangmodalpinjam".$this->getToken(),$request->all());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function confirmBarangModalPinjam($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/confirmbarangmodalpinjam/".$id.$this->getToken());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function indexBarangModalKembali(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/indexbarangmodalkembali" . $this->getToken());
        return view('dashboard.master.barang.barangmodalkembali.index',compact('data'));
    }
    public function addBarangModalKembali()
    {
        $datamentah = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/indexbarangmodalpinjam" . $this->getToken());
        $collection = collect($datamentah->json()['data']);
        $data = $collection->whereIn('barangfisik.status_pengambilan',1);
        return view('dashboard.master.barang.barangmodalkembali.add',compact('data'));
    }
    public function barangModalKembali($id){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/barangmodalkembali/id=$id".$this->getToken());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function importexcel(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|file'
        ]);
        if($validator->fails()){
            return back()->with('failed',$validator->errors());
        }else{
            $path1 = $request->file('file')->store('temp');
            $path=storage_path('app').'/'.$path1;
            Excel::import(new BarangImport, $path);
            return back()->with('import','file telah berhasil diimport');
        }
    }
    public function downloadexcel(){
        $file= public_path(). "/excel/barang.xlsx";
        return response()->download($file);
    }
    public function edit($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/show/". $id . $this->getToken());
        $datakategori = Http::withHeaders([
          'apikey' => $this->getApiKey()
      ])->get($this->api."/kategori" . $this->getToken());
        return view('dashboard.master.barang.edit',compact('data','datakategori'));
    }
    public function update(Request $request, $id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/update/".$id.$this->getToken(),$request->all());
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
        ])->delete($this->api."/barang/destroy/".$id.$this->getToken());
        if($data['code'] == 1){
            Alert::success('Operasi Sukses', $data['message']);
            return back();
        }else{
            Alert::error('Operasi Gagal', $data['message']);
            return back();
        }
    }
    public function exportexcel(){
        return Excel::download(new BarangExport, 'barangexport.xlsx');
    }
    public function getSpesifikBarangFisik(Request $request){
        $idbarang = $request->idbarang;
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/fisik" . $this->getToken());
        $collection = collect($data->json()['data']);
        $datafisik = $collection->whereIn('id_barang',$idbarang)->whereIn('status_pengambilan',0);
        foreach ($datafisik as $barangfisik) {
            echo "<option value=\"{$barangfisik['id']}\">{$barangfisik['kode']}</option>";
        }
    }
    public function getBarangSesuaiKategori(Request $request){
        $idkategori = $request->idkategori;
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang" . $this->getToken());
        $collection = collect($data->json()['data']);
        $databarang = $collection->whereIn('id_kategori',$idkategori);
        foreach ($databarang as $barang) {
            echo "<option value=\"{$barang['id']}\">{$barang['nama']}</option>";
        }
    }

    public function getBarangWithKagetgori(Request $request){
        $idkategori = $request->idkategori;
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang" . $this->getToken());
        $collection = collect($data->json()['data']);
        $databarang = $collection->whereIn('id_kategori',$idkategori);
        return view('_partials.databarang',compact('databarang'));
    }
    public function getallbarang()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang" . $this->getToken());
        $databarang = $data['data'];
        return view('_partials.databarang',compact('databarang'));
    }
    public function getInputBarangKeluar(){
      $datamentahbarang = Http::withHeaders([
        'apikey' => $this->getApiKey()
      ])->get($this->api."/barang" . $this->getToken());
      $collection = collect($datamentahbarang->json()['data']);
      $databarang = $collection->whereIn('id_kategori',2);
      return view('_partials.inputbarangkeluar',compact('databarang'));
    }
}
