<?php

namespace App\Services;


use App\Exceptions\ResourceException;
use App\Models\Role;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

class RoleService
{
    private function filterData(array &$data)
    {
        if(isset($data['display_name'])) {
            $data['display_name'] = e($data['display_name']);
        }
        if(isset($data['description'])) {
            $data['description'] = e($data['description']);
        }
        return $data;
    }

    public function create(array &$data)
    {
        $this->filterData($data);
        $role = Role::create($data);
        if (!empty($data['permissions'])) {
            try {
                $role->givePermissionTo($data['permissions']);
            } catch (PermissionDoesNotExist $e) {
                throw new ResourceException(null, ['roles' => '所选的权限不存在']);
            }
        }
        return $role;
    }

    public function update(Role $role, array &$data)
    {
        $this->filterData($data);
        $role->update($data);
        if (!empty($data['permissions'])) {
            try {
                $role->syncPermissions($data['permissions']);
            } catch (PermissionDoesNotExist $e) {
                throw new ResourceException(null, ['roles' => '所选的权限不存在']);
            }
        }
        return $role;
    }

}