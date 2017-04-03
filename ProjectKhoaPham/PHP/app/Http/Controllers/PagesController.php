<?php

namespace App\Http\Controllers;

use App\TheLoai;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    function __construct()
    {
        $theloai = TheLoai::all();
        view()->share('theloai', $theloai);
    }

    public function trangchu()
    {
        return view('pages.trangchu');
    }

    public function lienhe()
    {
        $theloai = TheLoai::all();
        return view('pages.lienhe');
    }
}

