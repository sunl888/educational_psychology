<?php

namespace App\Models;

use App\Models\Presenter\BannerPresenter;
use App\Models\Traits\Typeable;
use App\Support\Presenter\PresentableInterface;
use Carbon\Carbon;

class Banner extends BaseModel implements InterfaceTypeable, PresentableInterface
{
    use Typeable;

    protected $fillable = ['url', 'title', 'image', 'type_name', 'is_visible', 'creator_id', 'is_target_blank', 'enabled_at', 'expired_at'];
//    protected static $allowSortFields = ['type_name', 'is_visible'];
//    protected static $allowSearchFields = ['title', 'url'];
    protected $casts = [
        'is_visible' => 'boolean',
        'is_target_blank' => 'boolean'
    ];

    protected $dates = [
        'enabled_at',
        'expired_at'
    ];

    /**
     * 只获取显示的查询作用域
     * @param $query
     * @param bool $isVisible
     */
    public function scopeIsVisible($query, $isVisible = true)
    {
        $query->where('is_visible', $isVisible);
    }

    public function scopeEnabled($query)
    {
        if ($this->enable_at) {
            $now = Carbon::now();
            $query->where('enabled_at', '<=', $now);
        }
    }

    public function scopeNotExpired($query)
    {
        if ($this->expired_at) {
            $now = Carbon::now();
            $query->where('expired_at', '>', $now);
        }
    }

    public function scopeDisplayable($query)
    {
        $query->isVisible()->enabled()->notExpired();
    }

    public function getPresenter()
    {
        return new BannerPresenter($this);
    }

}
