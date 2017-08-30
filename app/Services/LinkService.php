<?php

namespace App\Services;

use App\Models\Link;

class LinkService
{
    private function filterData(array &$data)
    {
        if(isset($data['name']))
            $data['name'] = e($data['name']);
        if(isset($data['linkman']))
            $data['linkman'] = e($data['linkman']);
        return $data;
    }

    public function create(array $data)
    {
        $this->filterData($data);
        $link = Link::create($data);
        return $link;
    }

    public function update(Link $link, array $data)
    {
        $this->filterData($data);
        $link->update($data);
        return $link;
    }

}