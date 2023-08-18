<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminSekolahController extends Controller
{
    //
    function index()
    {
        $sekolah  = DB::table('sekolahs')->where('id', '1')->first();
        $data = [
            'title'   => 'Data Sekolah',
            'sekolah' => $sekolah,
            'content' => 'admin/sekolah/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function update(Request $request)
    {
        $sekolah  = Sekolah::find('1')->first();

        $data = $request->validate([
            'nama_sekolah' => 'required|min:3',
            'nidn' => 'required',
            'alamat' => 'required',
            'kepsek' => 'required',
            'nip_kepsek' => 'required',
        ]);
        $sekolah->update($data);
        Alert::success('Sukses', 'Konfigurasi telah diperbaharui');
        return redirect('/admin/sekolah');
    }
}
