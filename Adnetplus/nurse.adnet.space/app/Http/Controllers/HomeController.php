<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\Users;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Users $users)
    {
        // get search parameters
        $name = request()->get('name');
        $sex = request()->get('sex');
        $sortBy = request()->get('sort_by');
        $orderBy = request()->get('order_by');
        $userList = $users->search($name, $sex, $sortBy, $orderBy);
        return view('home', compact('userList', 'name', 'sex', 'sortBy', 'orderBy'));
    }
}
