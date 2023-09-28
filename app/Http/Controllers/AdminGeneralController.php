<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Nonstandard\Uuid;
use RealRashid\SweetAlert\Facades\Alert;

class AdminGeneralController extends Controller
{
    //

    function import($request, $modelImport)
    {
        $file = $request->file('file');
        $uuid1 = Uuid::uuid4()->toString();
        $uuid2 = Uuid::uuid4()->toString();
        $file_name = $uuid1 . $uuid2 . '.' . $file->getClientOriginalExtension();

        // $file_name = time() . "_" . $file->getClientOriginalName();

        $storage = 'uploads/excel/';
        $file->move($storage, $file_name);
        // $data['file'] = $storage . $file_name;

        Excel::import(new $modelImport, public_path('/uploads/excel/') . $file_name);

        Alert::success('Sukses', 'Data telah di import');
        return redirect()->back();
    }

    function download()
    {
        return response()->download('format/formatguru.xlsx');
    }
}
