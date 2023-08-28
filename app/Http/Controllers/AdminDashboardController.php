<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    function index()
    {
        $ta_id = auth()->user()->ta_id_active;
        $role = auth()->user()->role;

        if ($role == 'admin') {

            $data = [
                'kelas'   => Kelas::whereTaId($ta_id)->count(),
                'mapel'   => Mapel::whereTaId($ta_id)->count(),
                'guru'   => User::whereRole('guru')->count(),
                'siswa'   => Siswa::whereStatus('aktif')->count(),
                'content' => 'admin/dashboard/index'
            ];
            return view('admin/layouts/wrapper', $data);
        } else {
            return $this->guru();
        }
    }

    protected function guru()
    {
        $data = [
            'content' => 'admin/dashboard/guru'
        ];
        return view('admin/layouts/wrapper', $data);
    }
}
