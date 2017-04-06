<?php

namespace app\Repositories;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Config;

class Users
{
    public function getById($id, $locale = false)
    {
        $user = User::query()->find($id);
        $user->birth_date = formatBirthDate($user->birth_date, $locale);
        return $user;
    }

    public function search($name = null, $gender = null, $sortBy = null, $orderBy = null)
    {
        $query = User::query()->where('delete_flag', 0);
        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        if ($gender) {
            $gender = ($gender == 'male') ? 1 : 0;
            $query->where('gender', '=', $gender);
        }
        $query->where('delete_flag', 0);
        if ($sortBy && $orderBy) {
            $sortBy = $sortBy == 'date' ? 'updated_at' : $sortBy;
            $query->orderBy($sortBy, strtoupper($orderBy));
        } else {
            $query->orderBy('id', 'DESC');
        }
        $users = $query->paginate(Config::get('settings.paginate'));
        return $users;
    }

    public function create(array $data)
    {
        $date = str_replace(array("年","月","日"), "/", $data['birth_date']);
        $record = array(
            'name' => $data['name'],
            'birth_date' => $date,
            'gender' => $data['gender'],
            'address' => $data['address'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'created_by' => Auth::guard("admin")->id(),
            'updated_by' => Auth::guard("admin")->id()
        );
        $user = User::create($record);
        $user->code = generatorId(4,$user->id);
        $user->save();
        return $user;
    }

    public function update(array $data)
    {
        $id = $data['id'];
        $date = str_replace(array("年","月","日"), "/", $data['birth_date']);
        $user = User::findorfail($id);
        $record = array(
            'name' => $data['name'],
            'birth_date' => $date,
            'gender' => $data['gender'],
            'address' => $data['address'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'updated_by' => Auth::guard("admin")->id(),
        );
        $updateNow = $user->update($record);
        return  $updateNow;
    }
}