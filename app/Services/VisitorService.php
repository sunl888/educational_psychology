<?php

namespace App\Services;


use App\Models\Visitor;
use Illuminate\Http\Request;

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

    public function pageViewWithinToday()
    {
        return Visitor::withinToday()->sum('views');
    }

    public function uniqueVisitorViewWithinToday()
    {
        return Visitor::withinToday()->count();
    }
}
