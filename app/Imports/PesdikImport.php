<?php

namespace App\Imports;

use App\Models\Pesdik;
use Maatwebsite\Excel\Concerns\ToModel;

class PesdikImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pesdik([
            'nama_lengkap' => $row[0],
            'NIK' => $row[1],
            'NIPD' => $row[2],
            'JK' => $row[3]
        ]);
    }
}