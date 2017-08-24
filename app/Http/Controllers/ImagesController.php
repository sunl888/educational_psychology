<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use League\Glide\Server;

class ImagesController extends Controller
{
    public function show(Server $server, $path, Request $request)
    {
        return $server->getImageResponse(
            substr($path, 0, 2) . DIRECTORY_SEPARATOR . $path,
            $request->all());
    }
}
