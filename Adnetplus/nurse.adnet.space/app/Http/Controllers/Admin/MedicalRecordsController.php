<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use App\Http\Requests\MedicalRecordRequest;
use App\Http\Controllers\Controller;
use App\Repositories\MedicalRecords;
use App\Repositories\Users;

class MedicalRecordsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('admin');
    }

    public function show($userId, $day, Users $users, MedicalRecords $medicalRecords)
    {
        $user = $users->getById($userId, false);
        $medicalRecord = $medicalRecords->getByDate($userId, $day);
        return view('admin.medical.show', compact('user', 'medicalRecord'));
    }

    public function getAdd($userId, Users $users)
    {
        $user = $users->getById($userId, false);
        return view('admin.medical.add', compact('user'));
    }

    public function postAdd($userId, Users $users, MedicalRecords $medicalRecords)
    {
        $validator = $this->validator(request()->all());
        if ($validator->fails()) {
            $errors = $validator->errors();
            $user = $users->getById($userId, false);
            return view('admin.medical.add', compact('user', 'errors'));
        }
        $medicalRecords->create(request()->all());
        return redirect('admin/user/calendar/' . $userId);
    }

    public function getEdit($userId, $day, Users $users, MedicalRecords $medicalRecords)
    {
        $user = $users->getById($userId, false);
        $medicalRecord = $medicalRecords->getByDate($userId, $day);
        return view('admin.medical.edit', compact('user', 'medicalRecord'));
    }

    public function postEdit($userId, $day, Users $users, MedicalRecords $medicalRecords)
    {
        $validator = $this->validator(request()->all());
        if ($validator->fails()) {
            $errors = $validator->errors();
            $user = $users->getById($userId, false);
            $medicalRecord = $medicalRecords->getByDate($userId, $day);
            return view('admin.medical.edit', compact('user', 'medicalRecord', 'errors'));
        }
        $medicalRecords->update(request()->all());
        return redirect('admin/user/calendar/' . $userId);
    }

    protected function validator(array $data)
    {
        $validatedFields = getRequiredFields();
        if ($validatedFields) {
            return Validator::make($data, $validatedFields);
        }
        return true;
    }
}
