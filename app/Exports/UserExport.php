<?php

namespace App\Exports;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromArray, WithHeadings
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
        ])->get($this->api."/user" . $this->getToken());
        $datas = [];
        foreach ($data['data'] as $dataa) {
            $datamentah = [
                $dataa['id'],
                $dataa['firstname'],
                $dataa['lastname'],
                $dataa['unitkerja']['nama'],
                $dataa['nip'],
                $dataa['email'],
                $dataa['notelp'],
                $dataa['updated_at'],
            ];
            array_push($datas,$datamentah);
        }
        return $datas;
    }
    public function headings(): array
    {
        return [
            'ID User',
            'First Name',
            'Last Name',
            'Unit Kerja',
            'NIP',
            'Email',
            'Nomor Telephone',
            'Terakhir Di Update'
        ];
    }
}
