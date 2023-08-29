<?php

namespace App\Http\Controllers;

use App\Models\Ta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AdminTaController extends Controller
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
            $ta = Ta::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $ta = Ta::latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Tahun Ajaran',
            'ta' => $ta,
            'content' => 'admin/ta/index'
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

        $data = [
            'title'   => 'Tambah Tahun Ajaran',
            'content' => 'admin/ta/add'
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
        ]);

        Ta::create($data);
        Alert::success('Sukses', 'Tahun Ajaran telah ditambahkan');
        return redirect('/admin/ta');
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
            'title'   => 'Tambah Tahun Ajaran',
            'ta'      => Ta::find($id),
            'content' => 'admin/ta/add'
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

        $data = [
            'title'   => 'Tambah Tahun Ajaran',
            'ta' => Ta::find($id),
            'content' => 'admin/ta/add'
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
        $ta = Ta::find($id);
        $data = $request->validate([
            'name'        => 'required',
        ]);

        $ta->update($data);
        Alert::success('Sukses', 'Tahun Ajaran sukses disimpan');
        return redirect('/admin/ta/' . $id . '/edit');
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
        $ta = Ta::find($id);
        $ta->delete();
        Alert::success('Sukses', 'Tahun Ajaran sukses dihapus');
        return redirect('/admin/ta');
    }

    function changeTa()
    {
        $ta_id = request('ta_id');
        $user_id = auth()->user()->id;
        $user = User::with('ta')->find($user_id);
        $user->ta_id_active = $ta_id;
        $user->update();
        $user = User::with('ta')->find($user_id);
        // dd($user);
        Session::put('ta_name', $user->ta->name);
        Alert::success('Sukses', 'Tahun ajaran diubah ke ' . $user->ta->name);
        return redirect('/admin/dashboard');
    }
}
