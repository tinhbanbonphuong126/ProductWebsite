<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Repositories\Users;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('admin');
    }

    public function index(Users $users)
    {
        $name = request()->get('name');
        $sex = request()->get('sex');
        $sortBy = request()->get('sort_by');
        $orderBy = request()->get('order_by');
        $list = $users->search($name, $sex, $sortBy, $orderBy);
        return view('admin.user.list', compact('list', 'name', 'sex', 'sortBy', 'orderBy'));
    }

    /**
     * Show user calendar
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar($userId, Users $users)
    {
        $w = request()->has('w')? request()->get('w') : 'current';
        setSessionWeek($w);
        $weekDays = getWeekDays();
        $user = $users->getById($userId, false);
        return view('admin.user.calendar', compact('user', 'weekDays'));
    }

    public function getEdit($userId, Users $users)
    {
        $record = $users->getById($userId, false);
        return view('admin.user.edit', compact('record'));
    }

    public function postEdit(UserRequest $request, Users $users)
    {
        $users->update($request->all());
        return redirect('admin/user');
    }

    public function getAdd()
    {
        return view('admin.user.add');
    }

    public function postAdd(UserRequest $request, Users $users)
    {
        $users->create($request->all());
        return redirect('admin/user');
    }
}
