<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultGuardName = config('auth.defaults.guard');
       
        $resources = [
            'posts' => '文章',
            'categories' => '栏目',
            'banners' => ' banners',
            'links' => '链接',
            'settings' => '设置',
            'types' => '分类',
            'attachments' => '附件',
            'tags' => '标签',
            'users' => '用户',
            'roles' => '角色'
        ];

        $role = Role::firstOrCreate([
            'name' => 'admin',
        ], [
            'name' => 'admin',
            'guard_name' => $defaultGuardName,
            'display_name' => '管理员',
            'description' => '管理员拥有所有权限',
            'order' => 0,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        foreach ($resources as $resource => $resourceName) {
            foreach (['view' => '查看', 'add' => '添加', 'edit' => '编辑', 'delete' => '删除'] as $action => $actionName) {
                $displayName = $actionName . $resourceName;
                $permission = $this->createPermission($resource . '.' . $action, $defaultGuardName, $displayName, $displayName, 0);
                $role->givePermissionTo($permission);
            }
        }

        $permission = $this->createPermission(  'posts.restore', $defaultGuardName, '恢复删除的文章', '恢复删除的文章', 0);
        $role->givePermissionTo($permission);

        $permission = $this->createPermission(  'categories.page.view', $defaultGuardName, '查看单页', '查看单页', 0);
        $role->givePermissionTo($permission);

        $permission = $this->createPermission(  'categories.page.edit', $defaultGuardName, '编辑单页', '编辑单页', 0);
        $role->givePermissionTo($permission);

        $permission = $this->createPermission('roles.permissions', $defaultGuardName, '获取角色的权限', '获取角色的权限', 0);
        $role->givePermissionTo($permission);
    }

    private function createPermission($name, $guardName, $displayName, $description, $order)
    {
        return Permission::firstOrCreate(['name' => $name], [
            'name' => $name,
            'guard_name' => $guardName,
            'display_name' => $displayName,
            'description' => $description,
            'order' => $order,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }

}
