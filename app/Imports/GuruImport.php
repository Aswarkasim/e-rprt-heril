<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GuruImport implements ToModel, WithStartRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    function rules(): array
    {
        return [
            '1' => 'unique:users,username',
            '3' => 'unique:users,email',
            '5' => 'unique:users,nip',
        ];
    }

    // function customValidationMessages()
    // {
    //     return [
    //         '1.unique'  => '1. telah terdata'
    //     ];
    // }
    public function model(array $row)
    {


        return new User([
            //
            'username'  => $row[1],
            'name'      => $row[2],
            'email'     => $row[3],
            'password'  => Hash::make($row[4]),
            'role'      => 'guru',

            'nip'       => $row[5],
            'agama'     => $row[6],
            'alamat'    => $row[7],
            'nohp'      => $row[8],
            'jabatan'   => $row[9],
        ]);
    }

    function startRow(): int
    {
        return 2;
    }
}
