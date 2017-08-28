<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    private function filterData(array &$data)
    {
        if(isset($data['title']))
            $data['title'] = e($data['tittle']);
        return $data;
    }

    public function create(array &$data)
    {
        $this->filterData($data);
        $setting = Setting::create($data);
        return $setting;
    }

    public function update(Setting $setting, array &$data)
    {
        $this->filterData($data);
        $setting->update($data);
        return $setting;
    }

}
