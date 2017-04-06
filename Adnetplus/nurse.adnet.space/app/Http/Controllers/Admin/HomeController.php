<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Repositories\Staffs;
use App\Repositories\Users;
use App\Staff;
use App\Http\Requests\StaffRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('admin');
    }

    public function index(Staffs $staffs)
    {
        $name = request()->get('name');
        $sex = request()->get('sex');
        $sortBy = request()->get('sort_by');
        $orderBy = request()->get('order_by');
        $staffList = $staffs->search($name, $sex, $sortBy, $orderBy);
        return view('admin.home', compact('staffList', 'name', 'sex', 'sortBy', 'orderBy'));
    }
}
