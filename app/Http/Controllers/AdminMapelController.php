<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminMapelController extends Controller
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

        $ta = auth()->user()->ta_id_active;
        if ($cari) {
            $mapel = Mapel::with('guru')->where('name', 'like', '%' . $cari . '%')->whereTaId($ta)->latest()->paginate(10);
        } else {
            $mapel = Mapel::with('guru')->whereTaId($ta)->latest()->paginate(10);
        }
        $data = [
            'title'     => 'Manajemen Mapel',
            'mapel'     => $mapel,
            'content'   => 'admin/mapel/index'
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
        $ta_id = auth()->user()->ta_id_active;
        $data = [
            'title'     => 'Tambah Mapel',
            'guru'      => User::whereRole('guru')->get(),
            'kelas'     => Kelas::whereTaId($ta_id)->get(),
            'content'   => 'admin/mapel/add'
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
            'guru_id'     => 'required',
            'kelas_id'     => 'required',
            'kkm'     => 'required',
            'desc_cp'     => 'required'
        ]);

        $data['ta_id'] = auth()->user()->ta_id_active;

        Mapel::create($data);
        Alert::success('Sukses', 'Mapel telah ditambahkan');
        return redirect('/admin/mapel');
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
            'title'   => 'Tambah Mapel',
            'mapel'      => Mapel::find($id),
            'content' => 'admin/mapel/add'
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

        $ta_id = auth()->user()->ta_id_active;
        $data = [
            'title'   => 'Tambah Mapel',
            'mapel' => Mapel::find($id),
            'guru'    => User::whereRole('guru')->get(),
            'kelas'    => Kelas::whereTaId($ta_id)->get(),
            'content' => 'admin/mapel/add'
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
        $mapel = Mapel::find($id);
        $data = $request->validate([
            'name'        => 'required',
            'guru_id'     => 'required',
            'kelas_id'     => 'required',
            'kkm'     => 'required',
            'desc_cp'     => 'required'
        ]);

        $mapel->update($data);
        Alert::success('Sukses', 'Mapel sukses disimpan');
        return redirect('/admin/mapel/' . $id . '/edit');
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
        $mapel = Mapel::find($id);
        $mapel->delete();
        Alert::success('Sukses', 'Mapel sukses dihapus');
        return redirect('/admin/mapel');
    }
}
