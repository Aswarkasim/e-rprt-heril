<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //
        // Session
        $cari = request('cari');

        $ta = auth()->user()->ta_id_active;
        if ($cari) {
            $kelas = Kelas::with('guru')->where('name', 'like', '%' . $cari . '%')->whereTaId($ta)->latest()->paginate(10);
        } else {
            $kelas = Kelas::with('guru')->whereTaId($ta)->latest()->paginate(10);
        }
        $data = [
            'title'     => 'Manajemen Kelas',
            'kelas'     => $kelas,
            'content'   => 'admin/kelas/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $guru = User::whereRole('guru')->get();
        // dd($guru);

        $data = [
            'title'   => 'Tambah Kelas',
            'guru'   => $guru,
            'content' => 'admin/kelas/add'
        ];
        return view('admin.layouts.wrapper', $data);
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
        $data = $request->validate([
            'name'        => 'required',
            'guru_id'     => 'required'
        ]);

        $data['ta_id'] = auth()->user()->ta_id_active;

        Kelas::create($data);
        Alert::success('Sukses', 'Kelas telah ditambahkan');
        return redirect('/admin/kelas');
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
        $data = [
            'title'   => 'Tambah Kelas',
            'kelas'      => Kelas::find($id),
            'content' => 'admin/kelas/add'
        ];
        return view('admin.layouts.wrapper', $data);
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
        $guru = User::whereRole('guru')->get();
        $data = [
            'title'   => 'Tambah Kelas',
            'guru'      => $guru,
            'kelas' => Kelas::find($id),
            'content' => 'admin/kelas/add'
        ];
        return view('admin.layouts.wrapper', $data);
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
        $kelas = Kelas::with('guru')->find($id);
        $data = $request->validate([
            'name'        => 'required',
        ]);

        $data['guru_id']    = $kelas->guru_id;
        if ($request->guru_id != '') {
            $data['guru_id']    = $request->guru_id;
        }

        $kelas->update($data);
        Alert::success('Sukses', 'Kelas sukses disimpan');
        return redirect('/admin/kelas/' . $id . '/edit');
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
        $kelas = Kelas::find($id);
        $kelas->delete();
        Alert::success('Sukses', 'Kelas sukses dihapus');
        return redirect('/admin/kelas');
    }
}
