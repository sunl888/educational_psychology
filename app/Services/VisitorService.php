<?php

namespace App\Services;


use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cache;
use stdClass;
class VisitorService
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function record()
    {
        $ip = $this->request->ip();
        $visitor = $this->getVisitorByIpWithinToday($ip);
        if (is_null($visitor)) {
            // create
            Visitor::create([
                'ip' => $ip,
                'views' => 1,
                'referring_site' => $this->request->header('referer', null)
            ]);
        } else {
            // increment
            $this->increment($visitor);
        }
    }

    public function getVisitorByIpWithinToday($ip)
    {
        return Visitor::where('ip', $ip)->withinToday()->first();
    }

    protected function increment(Visitor $visitor)
    {
        return $visitor->increment('views');
    }


    public function getPVUVByDateWithoutCache(Carbon $date)
    {
        return [
            'page_view' => Visitor::withinOneday($date)->sum('views'),
            'unique_visitor' => Visitor::withinOneday($date)->count()
        ];
    }

    public function getPVUVByDateFromCache(Carbon $date)
    {
        return Cache::get($this->getCacheKey($date));
    }

    public function getRecentlyPVUVFromCache()
    {
        // todo 14 放到配置文件中
        $visitorRecordDays = setting('visitor_record_days', 14);
        $today = Carbon::today();
        if (!Cache::has('visitor::all_cached_dates')) {

            $allCachedDates = [];
            $day = $today->copy();
            for ($i = $visitorRecordDays; $i > 0; $i--) {
                $allCachedDates[] = $day->copy()->subDays($i);
            }
            Cache::forever('visitor::all_cached_dates', $allCachedDates);
            foreach ($allCachedDates as $date) {
                Cache::forever($this->getCacheKey($date), $this->getPVUVByDateWithoutCache($date));
            }
        } else {
            $allCachedDates = Cache::get('visitor::all_cached_dates');
        }

        $needResetCache = $allCachedDates[0]->diffInDays($today, false) > $visitorRecordDays;

        while ($allCachedDates[0]->diffInDays($today, false) > $visitorRecordDays) {
            Cache::forget($this->getCacheKey($allCachedDates[0]));
            array_shift($allCachedDates);

            $newDay = $allCachedDates[count($allCachedDates) - 1]->addDay();
            Cache::forever($this->getCacheKey($newDay), $this->getPVUVByDateWithoutCache($newDay));
            array_push($allCachedDates, $newDay);
        }

        if ($needResetCache) {
            Cache::forever('visitor::all_cached_dates', $allCachedDates);
        }

        $PVUVData = [];
        foreach ($allCachedDates as $date) {
            $PVUVData[] = $this->getPVUVByDateFromCache($date);
        }
        return $PVUVData;
    }

    private function getCacheKey($date)
    {
        if ($date instanceof Carbon) {
            $date = $date->toDateString();
        }
        return 'visitor::pv_uv::' . $date;
    }


}
