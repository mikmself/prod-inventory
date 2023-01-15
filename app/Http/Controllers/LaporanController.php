<?php

namespace App\Http\Controllers;

use App\Exports\BarangKeluar;
use App\Exports\BarangMasuk;
use App\Exports\BarangModalKeluar;
use App\Exports\BarangModalKembali;
use App\Exports\BarangModalPinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get("http://bpinvservice.bakaranproject.com/user/nonauth/indexbarang");
        $barang = collect($data->json()['data']);
        $barangModal = $barang->whereIn('id_kategori',1);
        $barangHabisPakai = $barang->whereIn('id_kategori',2);
        return view('dashboard.laporan.index',compact('barang','barangModal','barangHabisPakai'));
    }
    public function exportBarangMasuk(Request $request){
        return Excel::download(new BarangMasuk($request->all()), 'laporanbarangmasuk.xlsx');
    }
    public function exportBarangKeluar(Request $request){
        return Excel::download(new BarangKeluar($request->all()), 'laporanbarangkeluar.xlsx');
    }
    public function exportBarangModalKeluar(Request $request){
        return Excel::download(new BarangModalKeluar($request->all()), 'laporanbarangmodalkeluar.xlsx');
    }
    public function exportBarangModalPinjam(Request $request){
        return Excel::download(new BarangModalPinjam($request->all()), 'laporanbarangmodalpinjam.xlsx');
    }
    public function exportBarangModalKembali(Request $request){
        return Excel::download(new BarangModalKembali($request->all()), 'laporanbarangmodalKembali.xlsx');
    }
}
