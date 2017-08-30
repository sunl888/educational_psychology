<?php
/**
 * 站点设置
 */

namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Requests\Request;
use App\Http\Requests\SettingCreateRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use App\Transformers\Backend\SettingTransformer;

class SettingsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $settings = Setting::byType($request->get('type_id', null))
            ->withSort()
            ->withSimpleSearch()
            ->ordered()
            ->ancient()
            ->paginate($this->perPage());
        return $this->response()->paginator($settings, new SettingTransformer())
            ->setMeta(Setting::getAllowSortFieldsMeta() + Setting::getAllowSearchFieldsMeta());
    }

    public function store(SettingCreateRequest $request, SettingRepository $settingRepository)
    {
        $settingRepository->create($request->validated());
        return $this->response()->noContent();
    }

    public function update(Setting $setting, SettingUpdateRequest $request, SettingRepository $settingRepository)
    {
        $settingRepository->update($request->validated(), $setting);
        return $this->response()->noContent();
    }

    public function show(Setting $setting)
    {
        return $this->response()->item($setting, new SettingTransformer());
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return $this->response()->noContent();
    }
}
