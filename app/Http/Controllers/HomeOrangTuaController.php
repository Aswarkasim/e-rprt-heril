<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
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
        $semester = request('semester');

        $nilai = Nilai::with('mapel')->whereNisn($nisn)->whereKelasId($kelas_id)->whereSemester($semester)->get();
        $data = [
            'ta'            => Ta::get(),
            'nilai'         => $nilai,
            'siswa'     => $siswa,
            'content' => 'home/orangtua/index'
        ];
        return view('home.layouts.wrapper', $data);
    }
}
