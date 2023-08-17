<?php

namespace App\Imports;

use App\Models\Citizen;
// use Maatwebsite\Excel\Concerns\ToModel;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithUpserts;

HeadingRowFormatter::default('none');

class CitizenImport implements ToCollection, WithHeadingRow, WithMultipleSheets, WithUpserts
{
    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'id';
    }


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
    // public function model(array $row)
    // {
    //     if (!isset($row['Nama'])) {
    //         return null;
    //     }
    
    //     return new Citizen([
    //         'name' => $row['Nama'],
    //         'gender' => $row['Jenis Kelamin'],
    //         'is_head_of_family' => $row['Status KK'] == 'Ya' || $row['Status KK'] == 'ya' ? true : false,
    //         'rt' => $row['RT'],
    //         'position' => $row['Jabatan'],
    //     ]);
    // }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if (!isset($row['Nama'])) {
                return null;
            }
            Citizen::updateOrCreate(
                [
                    'name' => $row['Nama'],
                    'gender' => $row['Jenis Kelamin'],
                    'is_head_of_family' => $row['Status KK'] == 'Ya' || $row['Status KK'] == 'ya' ? true : false,
                    'rt' => $row['RT'],
                    'position' => $row['Jabatan'],
                ],
            );
        }
    }

}
