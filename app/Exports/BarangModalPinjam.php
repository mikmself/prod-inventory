<?php

namespace App\Exports;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class BarangModalPinjam implements FromArray, WithHeadings, WithEvents, WithStyles, WithDrawings, ShouldAutoSize, WithCustomStartCell
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
        ])->post($this->api."/laporan/barangmodalpinjam" . $this->getToken(),$this->req);
        $datas = [];
        foreach ($data['data'] as $dataa) {
            $datamentah = [
                $dataa['barang']['nama'],
                $dataa['unitkerja']['nama'],
                $dataa['barangfisik']['kode'],
                $dataa['tanggal_keluar'],
                $dataa['tanggal_kembali'],
                $dataa['ruang']['nama'],
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
            'Kode Barang Fisik',
            'Tanggal Keluar',
            'Tanggal Kembali',
            'Ruang',
            'Kegunaan'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A6:B6')
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('8094FF');
                $event->sheet->getDelegate()->getStyle('C6:D6')
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('8094FF');
                $event->sheet->getDelegate()->getStyle('E6:F6')
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('8094FF');
                $event->sheet->getDelegate()->getStyle('G6')
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('8094FF');
                        
                $event->sheet->setCellValue('B2', 'LAPORAN BARANG MODAL PINJAM');
                $event->sheet->setCellValue('B3', 'SMK NEGERI 1 PURWOKERTO');
                $event->sheet->getDelegate()->getStyle('B2')->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('B3')->getFont()->setSize(14);
            },
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('B2')->getFont()->setBold(true);        
        $sheet->getStyle('B3')->getFont()->setBold(true);    

        $sheet->getStyle('A6')->getFont()->setBold(true);
        $sheet->getStyle('B6')->getFont()->setBold(true);
        $sheet->getStyle('C6')->getFont()->setBold(true);
        $sheet->getStyle('D6')->getFont()->setBold(true);
        $sheet->getStyle('E6')->getFont()->setBold(true);
        $sheet->getStyle('F6')->getFont()->setBold(true);  
        $sheet->getStyle('G6')->getFont()->setBold(true);  
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('SMK NEGERI 1 PURWOKERTO');
        $drawing->setPath(public_path('/assets/img/logo/logosmk.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');
        return $drawing;
    }
    public function startCell(): string
    {
        return 'A6';
    }
}
