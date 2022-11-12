<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToCollection, WithHeadingRow
{
    public $api = "https://restinventory.bakaranproject.com";
    public function getToken(){
        return "?token=" . Session::get('token');
    }
    public function getApiKey(){
        return Session::get('apikey');
    }

    public function collection(Collection $rows)
    {
        // dd($rows);
        $data = Http::withHeaders([
            'apikey' => $this->getApiKey()
        ])->post($this->api."/barang/importexcel".$this->getToken(),[
            "rows" => $rows
        ]);
        return $data['code'];
    }
}
