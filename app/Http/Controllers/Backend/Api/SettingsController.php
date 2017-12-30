<?php
/**
 * 站点设置
 */

namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Controllers\Traits\Authorizable;
use App\Http\Requests\Backend\SettingRequest;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use App\Services\CustomOrder;
use App\Transformers\Backend\SettingTransformer;

class SettingsController extends ApiController
{
    use Authorizable;

    protected $neednotCheckAuth = ['setOrder'];
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(SettingRequest $request)
    {
        $settings = Setting::byType($request->get('type_name', null))
            ->withSort()
            ->withSimpleSearch()
            ->oldest()
            ->paginate($this->perPage());
        return $this->response()->paginator($settings, new SettingTransformer())
            ->setMeta(Setting::getAllowSortFieldsMeta() + Setting::getAllowSearchFieldsMeta());
    }

    public function store(SettingRequest $request, SettingRepository $settingRepository)
    {
        $settingRepository->create($request->validated());
        return $this->response()->noContent();
    }

    public function update(Setting $setting, SettingRequest $request, SettingRepository $settingRepository)
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

    /**
     * 拖拽排序
     * @param SettingRequest $request
     * @return \App\Support\Response\Response
     */
    public function setOrder(SettingRequest $request)
    {
        // todo message
        $data = $this->validate($request, [
            'index_order' => 'required|array',
            'model' => 'required|in:' . implode(',', array_keys(CustomOrder::$modelMapping))
        ]);
        // 检查是否有编辑权限
        $this->authorize($data['model'] . '.' . 'edit');
        app(CustomOrder::class)->setOrder($data['index_order'], $data['model']);
        return $this->response()->noContent();
    }
}
