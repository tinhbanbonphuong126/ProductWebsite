<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use Session;

use App\Http\Requests;

class LocaleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function setLocale($locale = 'vn')
    {
        if (!in_array($locale, ['vn', 'ja'])) {
            $locale = 'vn';
        }
        //Cookie::queue('locale', $locale);
        Session::set('locale', $locale);

        return redirect()->back();
    }
}
