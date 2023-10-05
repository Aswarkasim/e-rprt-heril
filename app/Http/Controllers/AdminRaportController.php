<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
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
        $kehadiran = Kehadiran::find($id);

        $kehadiran->s = request('nilai');
        $kehadiran->save();

        return response()->json(['success' => 'Berhasil']);
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
