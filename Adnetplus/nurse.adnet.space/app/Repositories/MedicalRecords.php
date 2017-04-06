<?php

namespace App\Repositories;

use App\MedicalRecord;
use Illuminate\Support\Facades\Auth;

class MedicalRecords
{
    public function getById($id)
    {
        $medicalRecord = MedicalRecord::query()->find($id);
        return $medicalRecord;
    }

    public function getByDate($userId, $day)
    {
        $medicalRecord = MedicalRecord::query()
            ->where('user_id', $userId)
            ->whereDate('created_at', '=', $day)
            ->first();
        return $medicalRecord;
    }

    public function create(array $data)
    {
        $record = [];
        $this->setFields($data, $record, 'C');
        $this->setSelectFields($data, $record);
        return MedicalRecord::create($record);
    }

    public function update(array $data)
    {
        $record = [];
        $this->setFields($data, $record, 'U');
        $this->setSelectFields($data, $record);
        $medicalRecord = MedicalRecord::findorfail($data['id']);
        return $medicalRecord->update($record);
    }

    private function setFields(array $data, array &$record, $mode = 'C')
    {
        $record = [
            'user_id' => $data['user_id'],
            'morning_blood_pressure_high' => $data['morning_blood_pressure_high'],
            'morning_blood_pressure_low' => $data['morning_blood_pressure_low'],
            'morning_pulse' => $data['morning_pulse'],
            'morning_body_temperature' => $data['morning_body_temperature'],
            'morning_weight' => $data['morning_weight'],
            'excretion_moisture' => $data['excretion_moisture'],
            'work_day' => $data['work_day'],
            'work_night' => $data['work_night'],
            'remarks' => $data['remarks'],
        ];
        $user_id = session()->get('user.id');
        if ($mode == 'C') {
            $record['created_by'] = $user_id;
            $record['updated_by'] = $user_id;
        } else {
            $record['updated_by'] = $user_id;
        }
    }

    private function setSelectFields(array $data, array &$record)
    {
        $localeFields = [
            'meal_breakfast_side_dish',
            'meal_breakfast_staple_food',
            'meal_lunch_side_dish',
            'meal_lunch_staple_food',
            'meal_snack_side_dish',
            'meal_snack_staple_food',
            'meal_dinner_side_dish',
            'meal_dinner_staple_food',
            'excretion_morning_flight',
            'excretion_morning_urine',
            'excretion_afternoon_flight',
            'excretion_afternoon_urine',
            'excretion_night_flight',
            'excretion_night_urine',
            'body_bath',
            'wipe_people',
            'rejection',
            'prohibition',
            'check_21_hour',
            'check_0_hour',
            'check_3_hour',
            'check_6_hour'
        ];
        foreach ($localeFields as $field) {
            $value = $data[$field];
            $record[$field . '_vn'] = $record[$field . '_ja'] = $value;
        }
    }
}