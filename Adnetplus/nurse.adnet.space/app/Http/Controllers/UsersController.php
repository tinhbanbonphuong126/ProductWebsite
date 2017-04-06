<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\Users;

class UsersController extends Controller
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
     * Show user detail
     *
     * @return \Illuminate\Http\Response
     */
    public function show($userId, Users $users)
    {
        $user = $users->getById($userId, true);
        return view('user.show', compact('user'));
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
        $user = $users->getById($userId, true);
        return view('user.calendar', compact('user', 'weekDays'));
    }
}
