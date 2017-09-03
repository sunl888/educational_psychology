<?php

namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\VisitorService;

class HomeController extends ApiController
{

    public function index(VisitorService $visitorService)
    {
        $posts = Post::byType(Category::TYPE_POST)->count();
        $users = User::count();
        $pv = $visitorService->pageViewWithinToday();
        $uv = $visitorService->uniqueVisitorViewWithinToday();
        return compact('posts', 'users', 'pv', 'uv');
    }
}
