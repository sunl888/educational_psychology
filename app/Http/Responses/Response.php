<?php


namespace App\Http\Responses;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

abstract class Response implements Responsable
{
    protected $data;
    protected $fractal;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function toResponse($request)
    {
        return new JsonResponse();
    }

}