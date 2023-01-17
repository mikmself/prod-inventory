<?php

namespace App\Exports;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class BarangKeluar implements FromArray, WithHeadings, WithEvents, WithStyles, WithDrawings, ShouldAutoSize, WithHeadingRow,WithStartRow
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
        ])->post($this->api."/laporan/barangkeluar" . $this->getToken(),$this->req);
        $datas = [];
        foreach ($data['data'] as $dataa) {
            $datamentah = [
                $dataa['barang']['nama'],
                $dataa['unitkerja']['nama'],
                $dataa['jumlah'],
                $dataa['tanggal_keluar'],
                $dataa['kegunaan']
            ];
            array_push($datas,$datamentah);
        }
        return $datas;
    }
    public function headings(): array
    {
        return [
            'Nama Barang',
            'Unit Kerja',
            'Jumlah',
            'Tanggal Keluar',
            'Kegunaan'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:B1')
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('8094FF');
                $event->sheet->getDelegate()->getStyle('C1:D1')
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('8094FF');
                $event->sheet->getDelegate()->getStyle('E1')
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('8094FF');
            },
        ];
    }
    public function headingRow(): int
    {
        return 3;
    }
    public function startRow(): int
    {
        return 4;
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->getStyle('C1')->getFont()->setBold(true);
        $sheet->getStyle('D1')->getFont()->setBold(true);
        $sheet->getStyle('E1')->getFont()->setBold(true);
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('SMK NEGERI 1 PURWOKERTO');
        $drawing->setPath(public_path('/assets/img/logo/logosmk.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('F1');
        return $drawing;
    }
}
