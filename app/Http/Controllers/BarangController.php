<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Imports\BarangImport;
use App\Imports\BarangMasukImport;
use App\Imports\BarangMasukModalImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

class BarangController extends Controller
{
    public function index()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang" . $this->getToken());
        return view('dashboard.master.barang.index',compact('data'));
    }
    public function confirm(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/indexconfrim" . $this->getToken());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'warning');
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
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'warning');
            return back();
        }
    }
    public function search(Request $request)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/search".$this->getToken(),$request->all());
        if($data['code'] == 1){
            return view('dashboard.master.barang.index',compact('data'));
        }else{
            toast('data tidak ditemukan','warning');
            return back();
        }
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
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'warning');
            return back();
        }
    }
    public function destroy($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->delete($this->api."/barang/destroy/".$id.$this->getToken());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return redirect(route('indexbarang'));
        }else{
            toast($data['message'],'warning');
            return redirect(route('indexbarang'));
        }
    }
    public function multipledelete(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/multipleDelete".$this->getToken(),$request->all());
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
        return view('dashboard.master.barang.index',compact('data'));
    }
    public function nextpage(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.index',compact('data'));
    }

    // Barang Fisk =====================================================================================================================================
    public function indexBarangFisik(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/fisik" . $this->getToken());
        return view('dashboard.master.barang.fisik',compact('data'));
    }
    public function previouspagebarangfisik(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.fisik',compact('data'));
    }
    public function nextpagebarangfisik(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.fisik',compact('data'));
    }

    // Barang Masuk =====================================================================================================================================
    public function indexBarangMasuk(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/indexbarangmasuk" . $this->getToken());
        return view('dashboard.master.barang.barangmasuk.index',compact('data'));
    }
    public function addBarangMasuk()
    {
        $datauser = Http::get($this->api."/user/nonauth/indexuser");
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
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'warning');
            return back();
        }
    }
    public function previouspagebarangmasuk(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.barangmasuk.index',compact('data'));
    }
    public function nextpagebarangmasuk(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.barangmasuk.index',compact('data'));
    }

    // Barang Keluar =====================================================================================================================================
    public function indexBarangKeluar(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/indexbarangkeluar" . $this->getToken());
        return view('dashboard.master.barang.barangkeluar.index',compact('data'));
    }
    public function filterBarangKeluar(Request $request){
        $iduser = $request->input('id_user');
        $dataunitkerja = Http::get($this->api."/user/nonauth/unitkerja");
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
        return view('dashboard.master.barang.barangkeluar.index',compact('data','dataunitkerja'));
    }
    public function addBarangKeluar()
    {
        $datamentahbarang = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang" . $this->getToken());
        $collection = collect($datamentahbarang->json()['data']['data']);
        $databarang = $collection->whereIn('id_kategori',2);
        $dataunitkerja = Http::get($this->api."/user/nonauth/indexunitkerja");
        return view('dashboard.master.barang.barangkeluar.add',compact('databarang','dataunitkerja'));
    }
    public function barangKeluar(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/barangkeluar".$this->getToken(),$request->all());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'warning');
            return back();
        }
    }
    public function confirmBarangKeluar($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/confirmbarangkeluar/".$id.$this->getToken());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'warning');
            return back();
        }
    }
    public function previouspagebarangkeluar(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.barangkeluar.index',compact('data'));
    }
    public function nextpagebarangkeluar(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.barangkeluar.index',compact('data'));
    }

    // Barang Modal Keluar =====================================================================================================================================
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
        $collection = collect($datamentahbarang->json()['data']['data']);
        $databarang = $collection->whereIn('id_kategori',1);
        $dataunitkerja = Http::get($this->api."/user/nonauth/indexunitkerja");
        $dataruang = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/ruang" . $this->getToken());
        return view('dashboard.master.barang.barangmodalkeluar.add',compact('databarang','dataunitkerja','dataruang'));
    }
    public function barangModalKeluar(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/barangmodalkeluar".$this->getToken(),$request->all());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'warning');
            return back();
        }
    }
    public function confirmBarangModalKeluar($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/confirmbarangmodalkeluar/".$id.$this->getToken());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'warning');
            return back();
        }
    }
    public function previouspagebarangmodalkeluar(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.barangmodalkeluar.index',compact('data'));
    }
    public function nextpagebarangmodalkeluar(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.barangmodalkeluar.index',compact('data'));
    }


    // Barang Modal Pinjam =====================================================================================================================================
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
        $collection = collect($datamentahbarang->json()['data']['data']);
        $databarang = $collection->whereIn('id_kategori',1);
        $dataunitkerja = Http::get($this->api."/user/nonauth/indexunitkerja");
        $dataruang = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/ruang" . $this->getToken());
        return view('dashboard.master.barang.barangmodalpinjam.add',compact('databarang','dataunitkerja','dataruang'));
    }
    public function barangModalPinjam(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/barangmodalpinjam".$this->getToken(),$request->all());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'warning');
            return back();
        }
    }
    public function confirmBarangModalPinjam($id)
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/confirmbarangmodalpinjam/".$id.$this->getToken());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'warning');
            return back();
        }
    }
    public function previouspagebarangmodalpinjam(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.barangmodalpinjam.index',compact('data'));
    }
    public function nextpagebarangmodalpinjam(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.barangmodalpinjam.index',compact('data'));
    }


    // Barang Modal Kembali =====================================================================================================================================
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
        $collection = collect($datamentah->json()['data']['data']);
        $data = $collection->whereIn('barangfisik.status_pengambilan',1);
        return view('dashboard.master.barang.barangmodalkembali.add',compact('data'));
    }
    public function barangModalKembali($id){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/barangmodalkembali/id=$id".$this->getToken());
        if($data['code'] == 1){
            toast($data['message'],'success');
            return back();
        }else{
            toast($data['message'],'warning');
            return back();
        }
    }
    public function previouspagebarangmodalkembali(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.barangmodalkembali.index',compact('data'));
    }
    public function nextpagebarangmodalkembali(Request $request){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($request->input('link') . "&token=" . Session::get('token'));
        return view('dashboard.master.barang.barangmodalkembali.index',compact('data'));
    }

    // Tambahan =======================================================================================================================================
    public function importexcel(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|file'
        ]);
        if($validator->fails()){
            toast('gagal, isi file sesuai yang diminta!','warning');
            return back();
        }else{
            $path1 = $request->file('file')->store('temp');
            $path=storage_path('app').'/'.$path1;
            try {
                Excel::import(new BarangImport, $path);
                toast('data berhasil di import','success');
                return back();
            } catch (ValidationException $e) {
                $failures = $e->failures();
                foreach ($failures as $failure) {
                    toast('error pada baris ke ' . $failure->row(),'error');
                }
            }
            
        }
    }
    public function importbarangmasukhabispakai(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|file'
        ]);
        if($validator->fails()){
            toast('gagal, isi file sesuai yang diminta!','warning');
            return back();
        }else{
            $path1 = $request->file('file')->store('temp');
            $path=storage_path('app').'/'.$path1;
            try {
                Excel::import(new BarangMasukImport, $path);
                toast('data berhasil di import','success');
                return back();
            } catch (ValidationException $e) {
                $failures = $e->failures();
                foreach ($failures as $failure) {
                    toast('error pada baris ke ' . $failure->row(),'error');
                }
            }
        }
    }
    public function importbarangmasukmodal(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|file'
        ]);
        if($validator->fails()){
            toast('gagal, isi file sesuai yang diminta!','warning');
            return back();
        }else{
            $path1 = $request->file('file')->store('temp');
            $path=storage_path('app').'/'.$path1;
            try {
                Excel::import(new BarangMasukModalImport, $path);
                toast('data berhasil di import','success');
                return back();
            } catch (ValidationException $e) {
                $failures = $e->failures();
                foreach ($failures as $failure) {
                    toast('error pada baris ke ' . $failure->row(),'error');
                }
            }
        }
    }
    public function downloadexcel(){
        $file= public_path(). "/excel/barang.xlsx";
        return response()->download($file);
    }    
    public function downloadexcelbarangmasuk(){
        $file= public_path(). "/excel/barangmasuk.xlsx";
        return response()->download($file);
    }
    public function exportexcel(){
        return Excel::download(new BarangExport, 'barangexport.xlsx');
    }
    public function getSpesifikBarangFisik(Request $request){
        $idbarang = $request->idbarang;
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/barang/fisik" . $this->getToken());
        $collection = collect($data->json()['data']['data']);
        $datafisik = $collection->whereIn('id_barang',$idbarang)->whereIn('status_pengambilan',0);
        foreach ($datafisik as $barangfisik) {
            echo "<option value=\"{$barangfisik['id']}\">{$barangfisik['kode']}</option>";
        }
    }
    public function getBarangSesuaiKategori(Request $request){
        $idkategori = $request->idkategori;
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/user/nonauth/indexbarang" . $this->getToken());
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
        ])->get($this->api."/user/nonauth/indexbarang" . $this->getToken());
        $collection = collect($data->json()['data']);
        $databarang = $collection->whereIn('id_kategori',$idkategori);
        return view('_partials.databarang',compact('databarang'));
    }
    public function getallbarang()
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get($this->api."/user/nonauth/indexbarang" . $this->getToken());
        $databarang = $data['data']['data'];
        return view('_partials.databarang',compact('databarang'));
    }
    public function getInputBarangKeluar(){
        $datamentahbarang = Http::withHeaders([
        'apikey' => $this->getApiKey()
        ])->get($this->api."/user/nonauth/indexbarang" . $this->getToken());
        $collection = collect($datamentahbarang->json()['data']);
        $databarang = $collection->whereIn('id_kategori',2);
        return view('_partials.inputbarangkeluar',compact('databarang'));
    }
    public function printBarcode(Request $request,$id){
        $databarangbarang = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/indexbarangmodalkeluar/" . $id . $this->getToken(),$request->all());
        return view('dashboard.master.barang.qrcode',compact('databarangbarang'));
    }
}
