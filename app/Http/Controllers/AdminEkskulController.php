<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminEkskulController extends Controller
{
    //
    function index()
    {
        $nisn       = request('nisn');
        $semester   = request('semester');
        $ta_id      = request('ta_id');

        $ekskul = Ekskul::whereNisn($nisn)->whereSemester($semester)->whereTaId($ta_id)->get();
        $data = [
            'title'   => 'Tambah Ekskul',
            'ekskul' => $ekskul,
            'content' => 'admin/ekskul/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required',
            'ta_id'        => 'required',
            'semester'        => 'required',
            'nisn'        => 'required',
            'predikat'        => 'required',
            'ket'        => 'required',
        ]);

        Ekskul::create($data);
        toast()->success('Sukses', 'Ekskul telah ditambahkan');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
        // dd($ekskul);
        $ekskul = Ekskul::find($id);
        $ekskul->delete();
        toast()->success('Sukses', 'Ekskul telah dihapus');
        return redirect()->back();
    }
}
