<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Peringkat;
use App\Models\Siswa;
use App\Models\Ta;
use Illuminate\Http\Request;

class HomeOrangTuaController extends Controller
{
    //

    function index()
    {
        $nisn = auth()->user()->username;
        $siswa = Siswa::whereNisn($nisn)->first();

        $kelas_id = $siswa->kelas_id;
        $ta_id = request('ta_id');
        $semester = request('semester');

        $nilai = Nilai::with('mapel')->whereNisn($nisn)->whereKelasId($kelas_id)->whereSemester($semester)->get();
        $peringkat = Peringkat::whereNisn($nisn)->whereKelasId($kelas_id)->whereTaId($ta_id)->whereSemester($semester)->first();

        $totalsiswa = Siswa::whereKelasId($kelas_id)->count();
        $data = [
            'ta'            => Ta::get(),
            'nilai'         => $nilai,
            'siswa'     => $siswa,
            'totalsiswa'     => $totalsiswa,
            'peringkat'     => $peringkat,
            'content' => 'home/orangtua/index'
        ];
        return view('home.layouts.wrapper', $data);
    }
}
