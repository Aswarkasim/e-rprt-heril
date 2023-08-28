<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cari = request('cari');

        if ($cari) {
            $siswa = Siswa::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $siswa = Siswa::latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Siswa',
            'siswa' => $siswa,
            'content' => 'admin/siswa/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $ta_id = auth()->user()->ta_id_active;
        $kelas = Kelas::whereTaId($ta_id)->get();
        $data = [
            'title'   => 'Tambah Siswa',
            'kelas'     => $kelas,
            'content' => 'admin/siswa/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $data = $request->validate([
            'name'        => 'required',
            'nisn'        => 'required|unique:siswas',
            'nis'        => 'required|unique:siswas',
            'kelas_id'        => 'required',
            'agama'        => 'required',
            'alamat'        => 'required',
            'nohp'        => 'required',
            'tempat_lahir'        => 'required',
            'tanggal_lahir'        => 'required',
        ]);

        //perbaiki upload imagenya
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $file_name = time() . "_" . $foto->getClientOriginalName();

            $storage = 'uploads/images/';
            $foto->move($storage, $file_name);
            $data['foto'] = $storage . $file_name;
        } else {
            $data['foto'] = NULL;
        }

        Siswa::create($data);
        Alert::success('Sukses', 'Siswa telah ditambahkan');
        return redirect('/admin/siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $siswa =  Siswa::find($id);
        $data = [
            'title'     =>  $siswa->name,
            'siswa'      => $siswa,
            'content'   => 'admin/siswa/detail'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $ta_id = auth()->user()->ta_id_active;
        $kelas = Kelas::whereTaId($ta_id)->get();

        $data = [
            'title'   => 'Tambah Siswa',
            'siswa' => Siswa::find($id),
            'kelas' => $kelas,
            'content' => 'admin/siswa/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $siswa = Siswa::find($id);
        $data = $request->validate([
            'name'        => 'required',
            'nisn'        => 'required',
            'nis'        => 'required',
            'kelas_id'        => 'required',
            'agama'        => 'required',
            'alamat'        => 'required',
            'nohp'        => 'required',
        ]);

        //perbaiki upload imagenya
        if ($request->hasFile('foto')) {

            if ($siswa->foto != '') {
                unlink($siswa->foto);
            }

            $foto = $request->file('foto');
            $file_name = time() . "_" . $foto->getClientOriginalName();

            $storage = 'uploads/images/';
            $foto->move($storage, $file_name);
            $data['foto'] = $storage . $file_name;
        } else {
            $data['foto'] = $siswa->foto;
        }

        $siswa->update($data);
        Alert::success('Sukses', 'Siswa sukses disimpan');
        return redirect('/admin/siswa/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $siswa = Siswa::find($id);
        if ($siswa->image != '') {
            unlink($siswa->image);
        }
        $siswa->delete();
        Alert::success('Sukses', 'Siswa sukses dihapus');
        return redirect('/admin/siswa/');
    }
}
