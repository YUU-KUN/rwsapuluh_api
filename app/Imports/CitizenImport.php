<?php

namespace App\Imports;

use App\Models\Citizen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

HeadingRowFormatter::default('none');

class CitizenImport implements ToModel, WithHeadingRow, WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            new CitizenImport()
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Citizen([
            'name' => $row['Nama'],
            'gender' => $row['Jenis Kelamin'],
            'is_head_of_family' => $row['Status KK'] == 'Ya' || $row['Status KK'] == 'ya' ? true : false,
            'rt' => $row['RT'],
            'position' => $row['Jabatan'],
        ]);
    }
}
