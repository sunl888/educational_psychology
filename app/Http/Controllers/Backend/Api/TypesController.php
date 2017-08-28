<?php

namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Requests\TypeCreateRequest;
use App\Http\Requests\TypeUpdateRequest;
use App\Models\InterfaceTypeable;
use App\Models\Type;
use App\Services\TypeService;
use App\Transformers\Backend\TypeTransformer;
use Illuminate\Http\Request;


class TypesController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $types = Type::byModel($request->get('model'))->ordered()->get();
        return $this->response()->collection($types, new TypeTransformer());
    }

    public function store(TypeCreateRequest $request, TypeService $typeService)
    {
        $typeService->create($request->validated());
        return $this->response()->noContent();
    }

    public function update(Type $type, TypeUpdateRequest $request, TypeService $typeService)
    {
        $typeService->update($type, $request->validated());
        return $this->response()->noContent();
    }

    /**
     * 删除类型
     * @param Type $type
     * @param Request $request
     * @return \App\Support\Response
     */
    public function destroy(Type $type, Request $request)
    {
        if (class_exists($type->model_name)) {
            $model = app($type->model_name);
            if ($model instanceof InterfaceTypeable) {
                if ($request->has('delete_relation')) {
                    // 需要删除关联数据
                    $model->byType($type)->delete();
                } else {
                    // 关联数据中的type_id 置为null
                    $model->byType($type)->update(['type_id' => null]);
                }
            }
        }
        $type->delete();
        return $this->response()->noContent();
    }

}
