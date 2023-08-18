<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    function index()
    {
        $data = [
            'content' => 'admin/dashboard/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }
}
