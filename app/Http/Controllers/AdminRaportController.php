<?php

namespace App\Http\Controllers;

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

        $siswa = Siswa::whereKelasId($kelas_id)->get();

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
            'ta'        => Ta::find($ta_id),
            'wali'      => User::find($user_id),
            'sekolah'   => Sekolah::find('1')->first(),
            'nilai'     => Nilai::with('mapel')->whereNisn($nisn)->whereTaId($ta_id)->whereKelasId($kelas_id)->whereSemester($semester)->get(),
        ];
        return view('admin.raport.cetak', $data);
    }
}
