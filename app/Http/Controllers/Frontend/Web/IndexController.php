<?php

namespace App\Http\Controllers\Frontend\Web;


class IndexController extends FrontendController
{
    public function index()
    {
        return view('theme::index');
    }
}