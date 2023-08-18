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
            'username'      => 'required',
            'password'      => 'required',
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            $user = User::with('ta')->find(auth()->user()->id);

            if ($user->role == 'admin') {
                Session::put('ta_name', $user->ta->name);
            }


            return redirect('admin/dashboard');
        }

        return back()->with('loginError', 'Gagal login. Email atau password anda salah');
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
