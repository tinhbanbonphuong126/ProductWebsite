<?php

use \Carbon\Carbon;
use \App\Repositories\MedicalRecords;

function generateOptions($type = 'meal_breakfast_side_dish', $selectedValue = 0, $locale = true)
{
    $type = $locale ? $type . '_' . getLocale() : $type . '_ja';
    $data = DB::table('medical_record_formats')->select('value')->where('name', '=', $type)->first();
    $jsonData = json_decode($data->value, true);
    $options = '<option value=""></option>';
    foreach ($jsonData as $id => $text) {
        if ($selectedValue == $id) {
            $options .= PHP_EOL . "<option value=\"{$id}\" selected>{$text}</option>";
        } else {
            $options .= PHP_EOL . "<option value=\"{$id}\">{$text}</option>";
        }
    }
    return $options;
}

function getOptionText($type = 'meal_breakfast_side_dish', $optionValue = 0, $locale = true)
{
    $type = $locale ? $type . '_' . getLocale() : $type . '_ja';
    $data = DB::table('medical_record_formats')->select('value')->where('name', '=', $type)->first();
    $jsonData = json_decode($data->value, true);
    $optionText = '';
    foreach ($jsonData as $id => $text) {
        if ($optionValue == $id) {
            $optionText = $text;
            break;
        }
    }
    return $optionText;
}

function generateInputs($type = 'meal_breakfast_side_dish')
{
    $inputs = '';
    $data = DB::table('medical_record_formats')->select('value')->where('name', 'LIKE', "%$type%")->get();
    $vnData = json_decode($data[0]->value, true);
    $jaData = json_decode($data[1]->value, true);
    foreach ($jaData as $id => $text) {
        $inputs .= <<<HTML
<tr>
    <td><input class="form-control" type="text" name="{$type}_ja[]" value="{$text}" data-id="{$id}"/></td>
    <td><input class="form-control" type="text" name="{$type}_vn[]" value="{$vnData[$id]}" data-id="{$id}"/></td>
</tr>
HTML;
    }
    return $inputs;
}

function checkRequiredField($type = 'meal_breakfast_side_dish')
{
    $record = DB::table('medical_record_formats')->select('required')->where('name', '=', $type . '_ja')->first();
    return $record->required;
}

function getRequiredFields()
{
    $records = DB::table('medical_record_formats')->select('name')->where('required', 1)->get();
    $requiredFields = [];
    foreach ($records as $index => $record) {
        if ($index % 2 == 0) {
            $field = substr($record->name, 0, strlen($record->name) - 3);
            $requiredFields[$field] = 'required';
        }
    }
    return $requiredFields;
}

function generateCheckbox($type = 'meal_breakfast_side_dish')
{
    $checked = checkRequiredField($type) ? 'checked' : '';
    $checkbox = '<input type="checkbox" name="'. $type .'" value="1" '. $checked .' class="regular-checkbox">';
    return $checkbox;
}

function generateRequiredLabel($type = 'meal_breakfast_side_dish')
{
    $required = checkRequiredField($type);
    return $required ? '<span class="color-red">※</span>' : '';
}

function setSessionWeek($w)
{
    $week = session('week') ? session('week') : 0;
    if ($w == 'current') {
        $week = 0;
    } elseif ($w == 'next') {
        $week++;
    } elseif ($w == 'prev') {
        $week--;
    }
    session(['week' => $week]);
}

function getWeekDays()
{
    date_default_timezone_set("Asia/Tokyo");

    $w = getWeek();
    $dt = new DateTime();
    $dt->setISODate($dt->format('o'), $dt->format('W') + $w);
    $periods = new DatePeriod($dt, new DateInterval('P1D'), 6);
    $arrDays = iterator_to_array($periods);
    $days = [];
    foreach ($arrDays as $day) {
        array_push($days, $day->format('d/m'));
    }
    return (getLocale() == 'vn') ? $days : array_map('getJapaneseDay', $days);
}

function getDaysInWeek($mode = 'cur')
{
    date_default_timezone_set("Asia/Tokyo");
    $days = [];
    if ($mode == 'next') {
        $key = 'next';
    } elseif ($mode == 'prev') {
        $key = 'last';
    } else {
        $key = 'this';
    }
    $monday = date('d/m', strtotime('monday ' . $key . ' week'));
    $tuesday = date('d/m', strtotime('tuesday ' . $key . ' week'));
    $wednesday = date('d/m', strtotime('wednesday ' . $key . ' week'));
    $thursday = date('d/m', strtotime('thursday ' . $key . ' week'));
    $friday = date('d/m', strtotime('friday ' . $key . ' week'));
    $saturday = date('d/m', strtotime('saturday ' . $key . ' week'));
    $sunday = date('d/m', strtotime('sunday ' . $key . ' week'));
    array_push($days, $monday);
    array_push($days, $tuesday);
    array_push($days, $wednesday);
    array_push($days, $thursday);
    array_push($days, $friday);
    array_push($days, $saturday);
    array_push($days, $sunday);
    return (getLocale() == 'vn') ? $days : array_map('getJapaneseDay', $days);
}

function getDaysInWeek2($mode = 'cur')
{
    $tz = 'Asia/Tokyo';
    $days = [];
    if ($mode == 'next') {
        $key = 'next';
    } elseif ($mode == 'prev') {
        $key = 'last';
    } else {
        $key = 'this';
    }
    $monday = (new Carbon($key . ' monday', $tz))->format('d/m');
    $tuesday = (new Carbon($key . ' tuesday', $tz))->format('d/m');
    $wednesday = (new Carbon($key . ' wednesday', $tz))->format('d/m');
    $thursday = (new Carbon($key . ' thursday', $tz))->format('d/m');
    $friday = (new Carbon($key . ' friday', $tz))->format('d/m');
    $saturday = (new Carbon($key . ' saturday', $tz))->format('d/m');
    $sunday = (new Carbon($key . ' sunday', $tz))->format('d/m');
    array_push($days, $monday);
    array_push($days, $tuesday);
    array_push($days, $wednesday);
    array_push($days, $thursday);
    array_push($days, $friday);
    array_push($days, $saturday);
    array_push($days, $sunday);
    return (getLocale() == 'vn') ? $days : array_map('getJapaneseDay', $days);
}

function getJapaneseDay($day)
{
    $dayParts = array_map('intval', explode('/', $day));
    return sprintf('%d月%d日', $dayParts[1], $dayParts[0]);
}

function isCurrentDate($day)
{
    $curDate = date('d/m', strtotime('today'));
    $curDate = (getLocale() == 'vn') ? $curDate : getJapaneseDay($curDate);
    return ($day === $curDate);
}

function isPreviousDate($day)
{
    if (isPreviousWeek()) {
        return true;
    }
    if (isNextWeek()) {
        return false;
    }
    if (isCurrentWeek()) {
        $curDate = date('d/m', strtotime('today'));
        $curDate = (getLocale() == 'vn') ? $curDate : getJapaneseDay($curDate);
        $days = getDaysInWeek('cur');
        return array_search($day, $days) < array_search($curDate, $days);
    }
}

function isCurrentWeek()
{
    return session('week') == 0;
}

function isNextWeek()
{
    return session('week') > 0;
}

function isPreviousWeek()
{
    return session('week') < 0;
}

function getWeek()
{
    return session('week') ? session('week') : 0;
}

function getSpecificDate($day)
{
    $w = getWeek();
    $dt = new DateTime();
    $dt->setISODate($dt->format('o'), $dt->format('W') + $w);
    $dt->add(new DateInterval("P" . $day . "D"));
    return $dt->format('Y-m-d');
}

function checkCurrentMedicalRecord($userId)
{
    $medicalRecords = new MedicalRecords();
    $medicalRecord = $medicalRecords->getByDate($userId, date('Y-m-d'));
    return $medicalRecord ? true : false;
}

function checkMedicalRecordDetail($userId, $day)
{
    $day = getSpecificDate($day);
    $medicalRecords = new MedicalRecords();
    $medicalRecord = $medicalRecords->getByDate($userId, $day);
    return $medicalRecord ? true : false;
}

function getLocale()
{
    return session('locale') ? session('locale') : 'vn';
}

function generatorId($len, $str)
{
    $numLen = strlen($str);
    for ($i = $numLen; $i < $len; $i++) {
        $str = "0" . $str;
    }
    return $str;
}

function getFieldByLocale($field)
{
    return $field . '_' . getLocale();
}

function addFieldsWithLocale(array &$data, $field, $value)
{
    $data[$field . '_vn'] = $data[$field . '_ja'] = $value;
}

function formatBirthDate($birthDate, $locale = false)
{
    $formatStr = $birthDate;
    if ($birthDate) {
        $d = Carbon::createFromFormat('Y-m-d', $birthDate);
        if ($locale) {
            if ('ja' == session('locale')) {
                $formatStr = sprintf('%s年%s年%s日', $d->format('Y'), $d->format('m'), $d->format('d'));
            } else {
                $formatStr = sprintf('Ngày %s tháng %s năm %s', $d->format('d'), $d->format('m'), $d->format('Y'));
            }
        } else {
            $formatStr = sprintf('%s年%s年%s日', $d->format('Y'), $d->format('m'), $d->format('d'));
        }
    }
    return $formatStr;
}

function getMedicalRecordFormatGroup($commonType)
{
    switch ($commonType) {
        case 'meal':
            $fieldList = [
                'meal_breakfast_side_dish',
                'meal_breakfast_staple_food',
                'meal_lunch_side_dish',
                'meal_lunch_staple_food',
                'meal_snack_side_dish',
                'meal_snack_staple_food',
                'meal_dinner_side_dish',
                'meal_dinner_staple_food',
            ];
            break;
        case 'excretion':
            $fieldList = [
                'excretion_morning_flight',
                'excretion_morning_urine',
                'excretion_afternoon_flight',
                'excretion_afternoon_urine',
                'excretion_night_flight',
                'excretion_night_urine',
            ];
            break;
        case 'bath':
            $fieldList = [
                'body_bath',
                'wipe_people',
                'rejection',
                'prohibition'
            ];
            break;
        case 'check':
            $fieldList = [
                'check_21_hour',
                'check_0_hour',
                'check_3_hour',
                'check_6_hour'
            ];
            break;
        default:
            $fieldList = [];
            break;
    }
    return $fieldList;
}

function hasEmailUniqueError($errorObj)
{
    $errors = $errorObj->all();
    return $errors[0] === 'is.not.unique';
}