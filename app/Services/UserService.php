<?php

namespace App\Services;

use App\Exceptions\ResourceException;
use App\Models\User;
use Hash;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use DB;

class UserService
{
    public function create(array &$data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = null;
        DB::transaction(function () use (&$data, &$user) {
            $user = User::create($data);
            if (!empty($data['roles'])) {
                try {
                    $user->assignRole($data['roles']);
                } catch (RoleDoesNotExist $e) {
                    throw new ResourceException(null, ['roles' => '所选的角色不存在']);
                }
            }

            if (!empty($data['permissions'])) {
                try {
                    $user->givePermissionTo($data['permissions']);
                } catch (PermissionDoesNotExist $e) {
                    throw new ResourceException(null, ['roles' => '所选的权限不存在']);
                }
            }
        });
        return $user;
    }

    public function update(User $user, array &$data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->fill($data)->save();

        if (!empty($data['roles'])) {
            try {
                $user->syncRoles($data['roles']);
            } catch (RoleDoesNotExist $e) {
                throw new ResourceException(null, ['roles' => '所选的角色不存在']);
            }
        }

        if (!empty($data['permissions'])) {
            try {
                $user->syncPermissions($data['permissions']);
            } catch (PermissionDoesNotExist $e) {
                throw new ResourceException(null, ['roles' => '所选的权限不存在']);
            }
        }

        return $user;
    }
}