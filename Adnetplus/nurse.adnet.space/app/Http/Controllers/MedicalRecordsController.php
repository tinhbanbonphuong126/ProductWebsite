<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use App\Repositories\Users;
use App\Repositories\MedicalRecords;
use App\Http\Requests\MedicalRecordRequest;

class MedicalRecordsController extends Controller
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

    public function show($userId, $day, Users $users, MedicalRecords $medicalRecords)
    {
        $user = $users->getById($userId, true);
        $medicalRecord = $medicalRecords->getByDate($userId, $day);
        return view('medical.show', compact('user', 'medicalRecord'));
    }

    public function getAdd($userId, Users $users)
    {
        $user = $users->getById($userId, true);
        return view('medical.add', compact('user'));
    }

    public function postAdd($userId, Users $users, MedicalRecords $medicalRecords)
    {
        $validator = $this->validator(request()->all());
        if ($validator->fails()) {
            $errors = $validator->errors();
            request()->session()->put('input', request()->all());
            $user = $users->getById($userId, true);
            return view('medical.add', compact('user', 'errors'));
        }
        request()->session()->forget('input');
        $medicalRecords->create(request()->all());
        return redirect('user/calendar/' . $userId);
    }

    public function getEdit($userId, $day, Users $users, MedicalRecords $medicalRecords)
    {
        $user = $users->getById($userId, true);
        $medicalRecord = $medicalRecords->getByDate($userId, $day);
        return view('medical.edit', compact('user', 'medicalRecord'));
    }

    public function postEdit($userId, $day, Users $users, MedicalRecords $medicalRecords)
    {
        $validator = $this->validator(request()->all());
        if ($validator->fails()) {
            $errors = $validator->errors();
            $user = $users->getById($userId, true);
            $medicalRecord = $medicalRecords->getByDate($userId, $day);
            return view('medical.edit', compact('user', 'medicalRecord', 'errors'));
        }
        $medicalRecords->update(request()->all());
        return redirect('user/calendar/' . $userId);
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
