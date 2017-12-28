<?php

namespace App\Models\Presenter;


use App\Support\Presenter\Presenter;

class BannerPresenter extends Presenter
{
    public function linkAttribute()
    {
        $url = ' href="' . ($this->url ?: 'javascript:;') . '"';
        $title = $this->title ? ' title="' . $this->title . '"' : '';
        $target = $this->is_target_blank ? ' target="_blank"' : '';
        return $url . $title . $target;
    }
}
