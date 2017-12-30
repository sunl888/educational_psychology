<?php
namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Traits\Authorizable;
use App\Http\Requests\Backend\RoleRequest;
use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Transformers\Backend\PermissionTransformer;
use App\Transformers\Backend\RoleTransformer;


class RolesController extends ApiController
{
    use Authorizable;

    public function __construct()
    {
        $this->middleware('auth');
        $this->addAbility([
            'allRoles' => 'view',
        ]);
    }

    /**
     * 显示指定角色
     * @param Role $role
     * @return \App\Support\Response\TransformerResponse
     */
    public function show(Role $role)
    {
        return $this->response()->item($role, new RoleTransformer());
    }

    /**
     * 获取所有角色(不分页 用于添加用户时显示)
     * @return \App\Support\Response\TransformerResponse
     */
    public function allRoles()
    {
        $roles = Role::ordered()->latest()->get();
        return $this->response()->collection($roles, new RoleTransformer());
    }

    /**
     * 角色列表
     * @return \App\Support\Response\TransformerResponse
     */
    public function index()
    {
        $roles = Role::withSimpleSearch()
            ->withSort()
            ->ordered()
            ->latest()
            ->paginate($this->perPage());
        return $this->response()->paginator($roles, new RoleTransformer())
            ->setMeta(Role::getAllowSearchFieldsMeta() + Role::getAllowSortFieldsMeta());
    }

    /**
     * 获取指定角色下面的权限
     * @param Role $role
     * @return \App\Support\Response\TransformerResponse
     */
    public function permissions(Role $role)
    {
        $permissions = $role->permissions()->ordered()->recent()->get();
        return $this->response()->collection($permissions, new PermissionTransformer());
    }


    /**
     * 创建角色
     * @param RoleRequest $request
     * @return mixed
     */
    public function store(RoleRequest $request, RoleRepository $roleRepository)
    {
        $roleRepository->create($request->validated());
        Role::create($request->all());
        return $this->response()->noContent();
    }

    /**
     * 更新角色
     * @param Role $role
     * @param RoleRequest $request
     * @return mixed
     */
    public function update(Role $role, RoleRequest $request, RoleRepository $roleRepository)
    {
        $roleRepository->update($request->validated(), $role);
        return $this->response()->noContent();
    }

    /**
     * 删除角色
     * @param Role $role
     * @param RoleRequest $request
     * @return \App\Support\Response\Response
     */
    public function destroy(Role $role, RoleRequest $request)
    {
        // todo 删除关联数据
        // 删除 model_has_roles 中 role_id = $role->id 的记录即可
        if ($request->has('delete_relation')) {
            // 需要删除关联数据

        } else {
            // 关联数据中的type_id 置为null
        }
        $role->delete();
        return $this->response()->noContent();
    }
}
