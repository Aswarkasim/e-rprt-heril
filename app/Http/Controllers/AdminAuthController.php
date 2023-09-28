<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    //
    function index()
    {
        return view('admin/auth/login');
    }

    function login(Request $request)
    {
        $data  = $request->validate([
            'role'          => 'required',
            'username'      => 'required',
            'password'      => 'required',
        ]);

        // dd($data);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            $user = User::with('ta')->find(auth()->user()->id);

            if ($user->role == 'admin') {
                Session::put('ta_name', $user->ta->name);
            } else if ($user->role == 'orangtua') {
                return redirect('home/orangtua');
            }


            return redirect('admin/dashboard');
        }

        return back()->with('loginError', 'Gagal login. Username atau password anda salah');
    }

    function register()
    {
    }

    function doRegister()
    {
    }

    function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('admin/auth');
    }
}
