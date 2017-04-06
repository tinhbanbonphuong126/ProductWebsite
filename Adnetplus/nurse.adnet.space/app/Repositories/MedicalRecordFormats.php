<?php

namespace App\Repositories;


use App\MedicalRecordFormat;

class MedicalRecordFormats
{
    public function loadItemList($type = 'meal_breakfast_side_dish')
    {
        $jsonData = MedicalRecordFormat::query()->where('name', '=', $type)->first();
        return json_decode($jsonData, true);
    }

    public function update($commonType = 'meal', array $data)
    {
        $typeList = getMedicalRecordFormatGroup($commonType);
        foreach ($typeList as $type) {
            $required = isset($data[$type]) ? $data[$type] : 0;
            $this->saveItem($type . '_ja', array_filter($data[$type . '_ja']), $required);
            $this->saveItem($type . '_vn', array_filter($data[$type . '_vn']), $required);
        }
    }

    private function saveItem($type, array $itemList, $required = 0)
    {
        $data = [];
        foreach ($itemList as $index => $item) {
            $data[$index + 1] = $item;
        }
        $record = MedicalRecordFormat::query()->where('name', '=', $type)->first();
        if ($record) {
            $record->update(['value' => json_encode($data), 'required' => $required]);
        } else {
            MedicalRecordFormat::create(['name' => $type, 'value' => json_encode($data), 'required' => $required]);
        }
    }
}