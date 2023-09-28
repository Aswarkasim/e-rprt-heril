<?php

namespace App\Http\Controllers;

use App\Imports\NilaiImport;
use App\Models\Desc;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Ta;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Nonstandard\Uuid;
use RealRashid\SweetAlert\Facades\Alert;

class AdminNilaiController extends Controller
{
    //
    function index()
    {


        $user_id = auth()->user()->id;
        // dd($user_id);

        $mapel_id = request('mapel_id');
        $kelas_id = request('kelas_id');
        $ta_id = request('ta_id');
        $semester = request('semester');

        $nilai =  $this->create($mapel_id, $kelas_id, $ta_id, $semester);


        $data = [
            'nilai'     => $nilai,
            'ta'            => Ta::get(),
            'kelas_pilih'  => Kelas::find($kelas_id),
            'mapel'     => Mapel::whereGuruId($user_id)->get(),
            'kelas'     => Kelas::get(),
            'content'   => 'admin/nilai/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function create($mapel_id, $kelas_id, $ta_id, $semester)
    {

        // $nilai = Nilai::whereMapelId($mapel_id)->whereKelasId($kelas_id)->whereTaId($ta_id)->whereSemester($semester)->get();

        $siswa = Siswa::whereKelasId($kelas_id)->get();
        // dd($siswa);

        foreach ($siswa as $item) {
            $nilai = Nilai::whereNisn($item->nisn)->whereMapelId($mapel_id)->whereKelasId($kelas_id)->whereTaId($ta_id)->whereSemester($semester)->first();

            if ($nilai == false) {
                $data = [
                    'nisn'          => $item->nisn,
                    'kelas_id'      => $kelas_id,
                    'mapel_id'      => $mapel_id,
                    'ta_id'         => $ta_id,
                    'semester'      => $semester,
                ];
                Nilai::create($data);
            }
        }

        $nilai = Nilai::with('siswa')->whereMapelId($mapel_id)->whereKelasId($kelas_id)->whereTaId($ta_id)->whereSemester($semester)->get();
        return $nilai;
    }

    function getKelas($ta_id)
    {
        if (!$ta_id) return response()->json('NOT OK');

        $kelas = Kelas::where('ta_id', $ta_id)->get();

        if ($kelas == false) return response()->json('NOT OK');

        $dataKelas = "";

        foreach ($kelas as $key) {
            $dataKelas .= "<option value='" . $key->id . "'>$key->name" . "</option>";
        }

        return response()->json($dataKelas);
    }

    function update()
    {
        $id = request('id');
        $field = request('field');
        $nilai = Nilai::find($id);

        $data = [
            $field => request('nilai')
        ];
        $nilai->update($data);

        return response()->json(['success' => 'Berhasil']);
    }

    function simpanNilai()
    {
        $mapel_id = request('mapel_id');
        $kelas_id = request('kelas_id');
        $ta_id = request('ta_id');
        $semester = request('semester');

        $nilai = Nilai::with('siswa')->whereMapelId($mapel_id)->whereKelasId($kelas_id)->whereTaId($ta_id)->whereSemester($semester)->get();


        foreach ($nilai as $item) {
            $n = Nilai::with('siswa')->find($item->id);



            $rerata = ($n->af_tp1 + $n->af_tp2 + $n->as_tes + $n->as_nontes) / 4;
            $n->nilai = $rerata;

            $desc = Desc::whereMapelId($mapel_id)
                ->where('start_value', '<=', $rerata)
                ->where('end_value', '>=', $rerata)
                ->first();

            $desc_1 = 'Anada ' . $n->siswa->name . ' ' . $desc->desc . ' ' . $n->mapel->desc_cp;
            $desc_2 = 'Anada ' . $n->siswa->name . ' perlu bimbingan ' . $n->mapel->desc_cp;
            $n->desc_1 = $desc_1;
            $n->desc_2 = $desc_2;
            $n->save();
        }

        Alert::success('Sukses', 'Kelas sukses disimpan');
        // toast('Nilai berhasil disimpan');
        return redirect()->back();
    }

    function import(Request $request)
    {
        $file = $request->file('file');
        $uuid1 = Uuid::uuid4()->toString();
        $uuid2 = Uuid::uuid4()->toString();
        $file_name = $uuid1 . $uuid2 . '.' . $file->getClientOriginalExtension();

        // $file_name = time() . "_" . $file->getClientOriginalName();

        $storage = 'uploads/excel/';
        $file->move($storage, $file_name);
        // $data['file'] = $storage . $file_name;

        $data = [
            'kelas_id'  => $request->kelas_id,
            'mapel_id'  => $request->mapel_id,
            'ta_id'     => $request->ta_id,
            'semester'  => $request->semester,
        ];

        Excel::import(new NilaiImport($data), public_path('/uploads/excel/') . $file_name);

        Alert::success('Sukses', 'Data telah di import');
        return redirect('/guru/nilai?ta_id=' . $data['ta_id'] . '&mapel_id=' . $data['mapel_id'] . '&kelas_id=' . $data['kelas_id'] . '&semester=' . $data['semester'] . '');
    }

    function download()
    {
        return response()->download('format/formatnilai.xlsx');
    }
}
