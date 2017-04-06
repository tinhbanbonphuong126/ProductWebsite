<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\MedicalRecordFormats;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MedicalRecordFormatsController extends Controller
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

    public function getEdit($type)
    {
        return view('admin.medical_format.' . $type);
    }

    public function postEdit($type, MedicalRecordFormats $medicalRecordFormats)
    {
        if (!$this->validateInput($type)) {
            $errors = ['message' => 'invalid input'];
            return view('admin.medical_format.' . $type, compact('errors'));
        }
        $medicalRecordFormats->update($type, request()->all());
        $type = $type == 'check' ? 'meal' : $type;
        return redirect('admin/medical-record-format/' . $type);
    }

    private function validateInput($type)
    {
        $fields = getMedicalRecordFormatGroup($type);
        if ($fields) {
            foreach ($fields as $field) {
                $jaList = array_filter(request($field . '_ja'));
                $vnList = array_filter(request($field . '_vn'));
                if (empty($jaList) || empty($vnList) || count($jaList) != count($vnList)) {
                    return false;
                }
            }
        }
        return true;
    }
}
