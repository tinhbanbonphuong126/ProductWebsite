<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Repositories\Staffs;
use App\Staff;
use App\Http\Requests\StaffRequest;
use Illuminate\Http\Request;

class StaffsController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('admin');
    }
    
    public function getEdit($staffId, Staffs $staffs)
    {
        $staff = $staffs->getById($staffId, true);
        return view('admin.staff.edit', compact('staff'));
    }

    public function postEdit(StaffRequest $request, Staffs $staffs)
    {
        $staffs->update($request->all());
        return redirect('admin/');
    }

    public function getAdd(Staffs $staffs)
    {
        return view('admin.staff.add');
    }

    public function postAdd(StaffRequest $request, Staffs $staffs)
    {
        $staffs->create($request->all());
        return redirect('admin/');
    }
}
