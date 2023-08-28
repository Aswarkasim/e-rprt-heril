<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminGuruController extends Controller
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
            $guru = User::whereRole('guru')->where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $guru = User::whereRole('guru')->latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Guru',
            'guru' => $guru,
            'content' => 'admin/guru/index'
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

        $data = [
            'title'   => 'Tambah Guru',
            'content' => 'admin/guru/add'
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
            'username'      => 'required|unique:users',
            'nip'        => 'required',
            'jabatan'        => 'required',
            'agama'        => 'required',
            'alamat'        => 'required',
            'nohp'        => 'required',
            'password'      => 'required|min:4',
            're_password'   => 'required|same:password'
        ]);

        $data['role'] = 'guru';
        $data['password'] = Hash::make($data['password']);

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

        User::create($data);
        Alert::success('Sukses', 'Guru telah ditambahkan');
        return redirect('/admin/guru');
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
        $guru =  User::find($id);
        $data = [
            'title'     =>  $guru->name,
            'guru'      => $guru,
            'content'   => 'admin/guru/detail'
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

        $data = [
            'title'   => 'Tambah Guru',
            'guru' => User::find($id),
            'content' => 'admin/guru/add'
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
        $guru = User::find($id);
        $data = $request->validate([
            'name'          => 'required',
            'username'      => 'required|unique:users,username,' . $guru->id,
            'nip'           => 'required',
            'jabatan'       => 'required',
            'agama'         => 'required',
            'alamat'        => 'required',
            'nohp'          => 'required',
        ]);

        if ($request->password == '') {
            $data['password'] = $guru->password;
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        if ($request->hasFile('foto')) {

            if ($guru->foto != '') {
                unlink($guru->foto);
            }

            $foto = $request->file('foto');
            $file_name = time() . "_" . $foto->getClientOriginalName();

            $storage = 'uploads/images/';
            $foto->move($storage, $file_name);
            $data['foto'] = $storage . $file_name;
        } else {
            $data['foto'] = $guru->foto;
        }

        $guru->update($data);
        Alert::success('Sukses', 'Guru sukses disimpan');
        return redirect('/admin/guru/' . $id . '/edit');
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
        $guru = User::find($id);
        if ($guru->image != '') {
            unlink($guru->image);
        }
        $guru->delete();
        Alert::success('Sukses', 'Guru sukses dihapus');
        return redirect('/admin/guru/');
    }
}
