<?php

namespace App\Http\Controllers;

use App\Models\Desc;
use App\Models\Mapel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminDescController extends Controller
{
    //
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
            $desc = Mapel::with('guru')->where('name', 'like', '%' . $cari . '%')->whereTaId($ta)->latest()->paginate(10);
        } else {
            $desc = Mapel::with('guru')->whereTaId($ta)->latest()->paginate(10);
        }
        $guru_id = auth()->user()->id;
        $data = [
            'title'     => 'Manajemen Desc',
            'desc'     => $desc,
            'mapel'     => Mapel::with('ta')->whereGuruId($guru_id)->whereTaId($ta)->get(),
            'content'   => 'admin/desc/index'
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
            'title'     => 'Tambah Desc',
            'content'   => 'admin/desc/add'
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
            'start_value'        => 'required',
            'end_value'        => 'required',
            'desc'        => 'required',
            'mapel_id'        => 'required',
        ]);


        Desc::create($data);
        Alert::success('Sukses', 'Desc telah ditambahkan');
        return redirect('/guru/desc/' . $data['mapel_id']);
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
            'title'   => 'Detail Desc',
            'mapel_id' => $id,
            'desc'      => Desc::whereMapelId($id)->get(),
            'content' => 'admin/desc/mapel'
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
            'title'   => 'Tambah Desc',
            'desc' => Desc::find($id),
            'content' => 'admin/desc/add'
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
        $desc = Desc::find($id);
        $data = $request->validate([
            'start_value'        => 'required',
            'end_value'        => 'required',
            'desc'        => 'required',
            'mapel_id'        => 'required',
        ]);

        $desc->update($data);
        Alert::success('Sukses', 'Desc sukses disimpan');
        return redirect('/guru/desc/' . $data['mapel_id']);
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
        $desc = Desc::find($id);
        $mapel_id = $desc->mapel_id;
        $desc->delete();
        Alert::success('Sukses', 'Desc sukses dihapus');
        return redirect('/guru/desc/' . $mapel_id);
    }
}
