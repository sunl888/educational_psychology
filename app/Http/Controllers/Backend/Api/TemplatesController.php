<?php

namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Services\TemplateService;
use Illuminate\Http\Request;
use stdClass;


class TemplatesController extends ApiController
{
    public function templates(Request $request)
    {
        return response()->json(app(TemplateService::class)->getTemplates($request->get('template_type')) ?: new stdClass());
    }
}
