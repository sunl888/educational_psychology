<?php

namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Requests\BannerCreateRequest;
use App\Http\Requests\BannerUpdateRequest;
use App\Models\Banner;
use App\Services\BannerService;
use App\Transformers\Backend\BannerTransformer;
use Illuminate\Http\Request;

class BannersController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $banners = Banner::byType($request->get('type_id', null))
            ->withSort()
            ->withSimpleSearch()
            ->ordered()
            ->recent()
            ->paginate($this->perPage());
        return $this->response()->paginator($banners, new BannerTransformer());
    }

    public function store(BannerCreateRequest $request, BannerService $bannerService)
    {
        $bannerService->create($request->validated());
        return $this->response()->noContent();
    }

    public function update(Banner $banner, BannerUpdateRequest $request, BannerService $bannerService)
    {
        $bannerService->update($banner, $request->validated());
        return $this->response()->noContent();
    }

    public function show(Banner $banner)
    {
        return $this->response()->item($banner, new BannerTransformer());
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return $this->response()->noContent();
    }
}
