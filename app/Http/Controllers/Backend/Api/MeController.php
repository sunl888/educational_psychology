<?php


namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Transformers\Backend\UserTransformer;
use Auth;

class MeController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return $this->response()->item(Auth::user(), new UserTransformer());
    }
}
