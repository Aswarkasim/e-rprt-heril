<?php

namespace App\Imports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NilaiImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }


    function startRow(): int
    {
        return 2;
    }


    public function model(array $row)
    {
        // dd($this->data['kelas_id']);

        $nilai = Nilai::whereNisn($row[1])
            ->whereTaId($this->data['ta_id'])
            ->whereMapelId($this->data['mapel_id'])
            ->whereKelasId($this->data['kelas_id'])
            ->whereSemester($this->data['semester'])
            ->first();

        if ($nilai) {
            $d = [
                'af_tp1'    => $row[3],
                'af_tp2'    => $row[4],
                'as_tes'    => $row[5],
                'as_nontes' => $row[6],
            ];
            $nilai->update($d);
        } else {
            return new Nilai([
                //
                'nisn'      => $row[1],
                'kelas_id'  => $this->data['kelas_id'],
                'mapel_id'  => $this->data['mapel_id'],
                'ta_id'     => $this->data['ta_id'],
                'semester'  => $this->data['semester'],
                'af_tp1'    => $row[3],
                'af_tp2'    => $row[4],
                'as_tes'    => $row[5],
                'as_nontes' => $row[6],
            ]);
        }
    }
}
