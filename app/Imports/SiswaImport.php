<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithValidation, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    function rules(): array
    {
        return [
            '1' => 'unique:siswas,nisn',
            '2' => 'unique:siswas,nis',
        ];
    }

    function startRow(): int
    {
        return 2;
    }


    public function model(array $row)
    {
        return new Siswa([
            //
            'nisn'          => $row[1],
            'nis'           => $row[2],
            'name'          => $row[3],
            'tempat_lahir'  => $row[4],
            'tanggal_lahir' => $row[5],
            'agama'         => $row[6],
            'gender'        => $row[7],
            'alamat'        => $row[8],
            'nohp'          => $row[9],
            'kelas_id'      => $row[10],

        ]);
    }
}
