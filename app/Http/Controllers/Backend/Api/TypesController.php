<?php

namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Controllers\Traits\Authorizable;
use App\Http\Requests\Backend\TypeRequest;
use App\Models\InterfaceTypeable;
use App\Models\Type;
use App\Repositories\TypeRepository;
use App\Transformers\Backend\TypeTransformer;


class TypesController extends ApiController
{
    use Authorizable;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Type $type)
    {
        return $this->response()->item($type, new TypeTransformer());
    }

    public function index(TypeRequest $request)
    {
        $types = Type::byModel($request->get('model'))->oldest()->get();
        return $this->response()->collection($types, new TypeTransformer());
    }

    public function store(TypeRequest $request, TypeRepository $typeRepository)
    {
        $typeRepository->create($request->validated());
        return $this->response()->noContent();
    }

    public function update(Type $type, TypeRequest $request, TypeRepository $typeRepository)
    {
        $typeRepository->update($request->validated(), $type);
        return $this->response()->noContent();
    }

    /**
     * 删除类型
     * @param Type $type
     * @param TypeRequest $request
     * @return \App\Support\Response\Response
     */
    public function destroy(Type $type, TypeRequest $request)
    {
        if (class_exists($type->model_name)) {
            $model = app($type->model_name);
            if ($model instanceof InterfaceTypeable) {
                if ($request->has('delete_relation')) {
                    // 需要删除关联数据
                    $model->byType($type)->delete();
                } else {
                    // todo 这里不允许为 null
                    // 关联数据中的type_id 置为null
                    // $model->byType($type)->update(['type_name' => null]);
                }
            }
        }
        $type->delete();
        return $this->response()->noContent();
    }

}
