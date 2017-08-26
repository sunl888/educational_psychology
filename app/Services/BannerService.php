<?php

namespace App\Services;

use App\Models\Banner;

class BannerService
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
        $banner = Banner::create($data);
        return $banner;
    }

    public function update(Banner $banner, array &$data)
    {
        $this->filterData($data);
        $banner->fill($data)->save();
        return $banner;
    }

}