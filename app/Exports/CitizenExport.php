<?php

namespace App\Exports;

use App\Models\Citizen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CitizenExport implements FromCollection, WithHeadings, WithMapping
{
    protected $index = 0;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Citizen::all();
    }

    /**
    * @var Citizen $citizen
    */
    public function map($citizen): array
    {
        return [
            ++$this->index,
            $citizen->name,
            $citizen->gender,
            $citizen->is_head_of_family ? 'Ya' : 'Tidak',
            $citizen->position,
            $citizen->rt,
        ];
    }


    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Jenis Kelamin',
            'Status KK',
            'Jabatan',
            'RT',
        ];
    }

}
