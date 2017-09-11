<?php

namespace App\Http\Controllers\Frontend\Web;


use App\Http\Controllers\Controller;
use View;

class FrontendController extends Controller
{
    public function __construct()
    {
        View::prependNamespace('theme', resource_path('views/frontend'));
    }
}
