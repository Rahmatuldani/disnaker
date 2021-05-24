<?php

namespace App\Exports;

use App\Models\IPK1;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IPK1Export implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $town;
    protected $month;

    function __construct($town, $month) {
        $this->town = $town;
        $this->month = $month;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data =  IPK1::join('ipk1_names', 'ipk1_names.ipk1_name_id', '=', 'ipk1s.ipk1_name_id')
        ->where('town_id', $this->town)
        ->where('ipk1_month', $this->month)
        ->get([
            'ipk1_name',
            '15-19l',
            '15-19p',
            '20-29l',
            '20-29p',
            '30-44l',
            '30-44p',
            '45-54l',
            '45-54p',
            '55l',
            '55p',
        ]);

        return $data;
    }

    public function headings(): array
    {
        return [
            'Pencari Kerja',
            '15-19 Laki-laki',
            '15-19 Perempuan',
            '20-29 Laki-laki',
            '20-29 Perempuan',
            '30-44 Laki-laki',
            '30-44 Perempuan',
            '45-54 Laki-laki',
            '45-54 Perempuan',
            '55+ Laki-laki',
            '55+ Perempuan',
        ];
    }
}
