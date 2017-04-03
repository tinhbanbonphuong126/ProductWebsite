<?php

namespace App\Http\Controllers;

use App\TheLoai;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function trangchu()
    {
        $theloai = TheLoai::all();
        return view('pages.trangchu', ['theloai' => $theloai]);
    }
}
