<?php

namespace App\Repositories;


use App\Models\Banner;
use Carbon\Carbon;

class BannerRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Banner::class;
    }

    public function filterData(array &$data)
    {
        if(isset($data['title']))
            $data['title'] = e($data['title']);
        if (isset($data['enabled_at']))
            $data['enabled_at'] = Carbon::createFromTimestamp(strtotime($data['enabled_at']));
        if (isset($data['expired_at']))
            $data['expired_at'] = Carbon::createFromTimestamp(strtotime($data['expired_at']));
        return $data;
    }

    public function preCreate(array &$data)
    {
        $this->filterData($data);
        // todo create_id 放到控制器里面
        $data['creator_id'] = auth()->id();
        return $data;
    }


    public function preUpdate(array &$data)
    {
        return $this->filterData($data);
    }

}
