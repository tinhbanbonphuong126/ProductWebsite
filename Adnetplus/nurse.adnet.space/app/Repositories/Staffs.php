<?php

namespace app\Repositories;

use Config;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Staff;

class Staffs
{
    protected $model;

    public function getById($id, $format = false)
    {
        $staff = Staff::query()->find($id);
        if ($format) {
            $staff->birth_date = $this->formatBirthDate($staff->birth_date);
        }
        return $staff;
    }

    public function search($name = null, $gender = null, $sortBy = null, $orderBy = null)
    {
        $query = Staff::query()->where('delete_flag', 0);
        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        if ($gender) {
            $gender = ($gender == 'male') ? 1 : 0;
            $query->where('gender', '=', $gender);
        }
        $query->where('is_admin', 0)->where('delete_flag', 0);
        if ($sortBy && $orderBy) {
            $sortBy = $sortBy == 'date' ? 'updated_at' : $sortBy;
            $query->orderBy($sortBy, strtoupper($orderBy));
        } else {
            $query->orderBy('id', 'DESC');
        }
        $staffs = $query->paginate(Config::get('settings.paginate'));
        return $staffs;
    }

    public function create(array $data)
    {
        $date = str_replace(array("年", "月", "日"), "/", $data['birth_date']);
        $data = array(
            'code' => '',
            'name' => $data['name'],
            'birth_date' => $date,
            'gender' => $data['gender'],
            'nationality' => $data['nationality'],
            'address' => $data['address'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'created_by' => Auth::guard("admin")->id(),
            'updated_by' => Auth::guard("admin")->id(),
        );
        $staff = Staff::create($data);

        $staff->code = generatorId(4, $staff->id);
        $staff->save();
        return $staff;
    }

    public function update(array $data)
    {
        $id = $data['id'];
        $date = str_replace(array("年", "月", "日"), "/", $data['birth_date']);
        $user = Staff::findorfail($id);
        $updateValues = array(
            'name' => $data['name'],
            'birth_date' => $date,
            'gender' => $data['gender'],
            'nationality' => $data['nationality'],
            'address' => $data['address'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'updated_by' => Auth::guard("admin")->id(),
        );

        if ($user->password != $data['password']) {
            $updateValues['password'] = bcrypt($data['password']);
        }

        $updateNow = $user->update($updateValues);

        return $updateNow;
    }

    private function formatBirthDate($birthDate)
    {
        $formatStr = $birthDate;
        if ($birthDate) {
            $d = Carbon::createFromFormat('Y-m-d', $birthDate);
            if ('ja' == session('locale')) {
                $formatStr = sprintf('%s年%s年%s日', $d->format('Y'), $d->format('m'), $d->format('d'));
            } else {
                $formatStr = sprintf('Ngày %s tháng %s năm %s', $d->format('d'), $d->format('m'), $d->format('Y'));
            }
        }
        return $formatStr;
    }
}