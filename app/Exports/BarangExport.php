<?php

namespace App\Exports;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromArray, WithHeadings
{
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
        ])->get($this->api."/barang" . $this->getToken());
        // dd($data['data']);
        $datas = [];
        foreach ($data['data'] as $dataa) {
            $datamentah = [
                $dataa['id'],
                $dataa['nama'],
                $dataa['kategori']['nama_kategori'],
                $dataa['stok'],
                $dataa['satuan'],
                $dataa['updated_at']
            ];
            array_push($datas,$datamentah);
        }
        return $datas;
    }
    public function headings(): array
    {
        return [
            'ID Barang',
            'Nama Barang',
            'Kategori',
            'Stok',
            'Satuan',
            'Updated At'
        ];
    }
}
