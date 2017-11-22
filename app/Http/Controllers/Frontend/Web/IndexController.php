<?php

namespace App\Http\Controllers\Frontend\Web;


use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view(THEME_NP . 'index');
    }
}
