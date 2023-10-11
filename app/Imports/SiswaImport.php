<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */



    function startRow(): int
    {
        return 2;
    }


    public function model(array $row)
    {

        // dd($row[1]);
        $password = $row[11];
        if ($row[11] == '') {
            $password == '123456789';
        }

        $data = [
            'username'  => $row[1],
            'name'      => $row[3],
            'role'      => 'orangtua',
            'password'  => Hash::make($password),
        ];

        $user = User::whereUsername($data['username'])->first();
        // dd($user);

        if ($user) {
            $user->update($data);
        } else {
            User::create($data);
        }

        $dataSiswa = [
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
            'nama_wali'      => $row[12],
        ];

        $siswa = Siswa::whereNisn($dataSiswa['nisn'])->whereNis($dataSiswa['nis'])->first();

        // dd($siswa);
        if ($siswa) {
            $siswa->update($dataSiswa);
        } else {
            Siswa::create($dataSiswa);
        }

        // return dd('a');
    }
}
