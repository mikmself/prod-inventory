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
use PDF;

class LaporanController extends Controller
{
    public function index(){
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->get("http://bpinvservice.bakaranproject.com/user/nonauth/indexbarang");
        $barang = collect($data->json()['data']);
        $barangModal = $barang->whereIn('id_kategori',1);
        $barangHabisPakai = $barang->whereIn('id_kategori',2);
        $unitkerja = Http::get($this->api."/user/nonauth/indexunitkerja");
        return view('dashboard.laporan.index',compact('barang','barangModal','barangHabisPakai','unitkerja'));
    }
    public function exportBarangMasuk(Request $request){
        return Excel::download(new BarangMasuk($request->all()), date('d-m-y-H-i-s',time()) . 'barangmasuk.xlsx');
    }
    public function exportBarangKeluar(Request $request){
        return Excel::download(new BarangKeluar($request->all()), date('d-m-y-H-i-s',time()) . 'barangkeluar.xlsx');
    }
    public function exportBarangModalKeluar(Request $request){
        return Excel::download(new BarangModalKeluar($request->all()), date('d-m-y-H-i-s',time()) . 'barangmodalkeluar.xlsx');
    }
    public function exportBarangModalPinjam(Request $request){
        return Excel::download(new BarangModalPinjam($request->all()), date('d-m-y-H-i-s',time()) . 'barangmodalpinjam.xlsx');
    }
    public function exportBarangModalKembali(Request $request){
        return Excel::download(new BarangModalKembali($request->all()), date('d-m-y-H-i-s',time()) . 'barangmodalKembali.xlsx');
    }
    public function laporanBarangKeluarUnitKerja(Request $request){
        $barangkeluar = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/laporan/laporanbarangkeluarunitkerja".$this->getToken(),$request->all());
        view()->share('employee',$barangkeluar);
        $pdfContent = PDF::loadView('dashboard.laporan.cetak', compact('barangkeluar'))->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "barang habis pakai unit kerja.pdf"
        );
    }
}
