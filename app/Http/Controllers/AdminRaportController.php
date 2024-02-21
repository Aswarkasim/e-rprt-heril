<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Peringkat;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Ta;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRaportController extends Controller
{
    //

    function index()
    {

        $user_id = auth()->user()->id;
        // dd($user_id);

        $kelas_id = request('kelas_id');
        $ta_id = request('ta_id');
        $semester = request('semester');

        $siswa = Siswa::with('kehadiran')->whereKelasId($kelas_id)->get();

        foreach ($siswa as $item) {
            $k = Kehadiran::whereNisn($item->nisn)->whereTaId($ta_id)->whereSemester($semester)->first();
            if ($k == null) {
                $data = [
                    'nisn'          => $item->nisn,
                    'ta_id'         => $ta_id,
                    'semester'      => $semester,
                ];
                Kehadiran::create($data);
            }
        }


        $data = [
            'siswa'         => $siswa,
            'ta'            => Ta::get(),
            'kelas_pilih'   => Kelas::find($kelas_id),
            'mapel'         => Mapel::whereGuruId($user_id)->get(),
            'kelas'         => Kelas::get(),
            'content'       => 'admin/raport/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function cetak()
    {
        $user_id = auth()->user()->id;
        $nisn = request('nisn');

        $kelas_id = request('kelas_id');
        $ta_id = request('ta_id');
        $semester = request('semester');

        $data = [
            'siswa'     => Siswa::whereNisn($nisn)->first(),
            'kehadiran' => Kehadiran::whereTaId($ta_id)->whereNisn($nisn)->whereSemester($semester)->first(),
            'ekskul'    => Ekskul::whereTaId($ta_id)->whereNisn($nisn)->whereSemester($semester)->get(),
            'ta'        => Ta::find($ta_id),
            'wali'      => User::find($user_id),
            'sekolah'   => Sekolah::find('1')->first(),
            'nilai'     => Nilai::with('mapel')->whereNisn($nisn)->whereTaId($ta_id)->whereKelasId($kelas_id)->whereSemester($semester)->get(),
        ];
        return view('admin.raport.cetak', $data);
    }

    function kehadiran()
    {
        $id = request('id');
        $field = request('field');
        $kehadiran = Kehadiran::find($id);
        // log($kehadiran);

        $kehadiran->$field = request('nilai');
        $kehadiran->save();

        return response()->json(['success' => 'Berhasil']);
    }

    function peringkat()
    {
        $kelas_id = request('kelas_id');
        $ta_id = request('ta_id');
        $semester = request('semester');
        $peringkat = Peringkat::with('siswa')->whereKelasId($kelas_id)->whereTaId($ta_id)->whereSemester($semester)->orderBy('peringkat', 'ASC')->get();
        // dd($peringkat);
        $data = [
            'peringkat'         => $peringkat,
            'content'           => 'admin/raport/peringkat'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function submitPesan(Request $request, $id)
    {

        $peringkat = Peringkat::find($id);
        $data = [
            'pesan' => $request->pesan . $id
        ];
        $peringkat->update($data);
        return redirect()->back();
    }

    function generatePeringkat()
    {
        $kelas_id = request('kelas_id');
        $ta_id = request('ta_id');
        $semester = request('semester');

        $nilai = Nilai::whereTaId($ta_id)->whereSemester($semester)->whereKelasId($kelas_id)->get();
        foreach ($nilai as $row) {
            $rerata = Nilai::whereNisn($row->nisn)->avg('nilai');
            // print_r($rerata);

            $peringkat = Peringkat::whereNisn($row->nisn)->whereTaId($ta_id)->whereSemester($semester)->whereKelasId($kelas_id)->first();
            if ($peringkat == null) {

                $d = [
                    'nisn'          => $row->nisn,
                    'kelas_id'      => $kelas_id,
                    'ta_id'         => $ta_id,
                    'semester'      => $semester,
                    'peringkat'     => 0,
                    'rerata_nilai'  => $rerata
                ];
                Peringkat::create($d);
            }
            $p = Peringkat::whereTaId($ta_id)->whereSemester($semester)->whereKelasId($kelas_id)->orderBy('rerata_nilai', 'DESC')->get();
            $a = 0;
            foreach ($p as $row) {
                // die('masuk');
                $a = $a + 1;
                // print_r($a);
                $d = [
                    'peringkat'     => $a,
                ];
                $row->update($d);
            }

            return redirect('/guru/peringkat?ta_id=' . $ta_id . '&kelas_id=' . $kelas_id . '&semester=' . $semester . '');
        }
    }

    function getKelas($ta_id)
    {

        $user_id = auth()->user()->id;
        if (!$ta_id) return response()->json('NOT OK');

        $kelas = Kelas::where('ta_id', $ta_id)->whereGuruId($user_id)->get();

        if ($kelas == false) return response()->json('NOT OK');

        $dataKelas = "";

        foreach ($kelas as $key) {
            $dataKelas .= "<option value='" . $key->id . "'>$key->name" . "</option>";
        }

        return response()->json($dataKelas);
    }
}
