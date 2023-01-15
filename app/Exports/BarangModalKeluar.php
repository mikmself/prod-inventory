<?php

namespace App\Exports;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangModalKeluar implements FromArray, WithHeadings
{
    public $req;
    public function __construct($req)
    {
        $this->req = $req;
    }

    public $api = "http://bpinvservice.bakaranproject.com";
    public function getToken(){
        return "?token=" . Session::get('token');
    }
    public function getApiKey(){
        return Session::get('apikey');
    }
    public function array(): array
    {
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/laporan/barangmodalkeluar" . $this->getToken(),$this->req);
        $datas = [];
        foreach ($data['data'] as $dataa) {
            $datamentah = [
                $dataa['barang']['nama'],
                $dataa['user']['firstname'] + " " + $dataa['user']['lastname'],
                $dataa['barangfisik']['kode'],
                $dataa['tanggal_keluar'],
                $dataa['ruang']['nama']
            ];
            array_push($datas,$datamentah);
        }
        return $datas;
    }
    public function headings(): array
    {
        return [
            'Nama Barang',
            'Nama User',
            'Kode Barang Fisik',
            'Tanggal Keluar',
            'Ruang'
        ];
    }
}
