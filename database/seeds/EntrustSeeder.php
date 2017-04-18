<?php

use Illuminate\Database\Seeder;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->makePermission();
        $this->makeRole();
    }

    /**
     * @name        makeRole
     * @DateTime    ${DATE}
     * @param       \Illuminate\Http\Request.
     * @return      null
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function makeRole (){
        $roles = [
            [
              'name' => 'Admin',
              'name_zh' => '管理组',
              'name_jp' => '管理组',
              'description'  => '最高级别角色',
            ],[
                'name' => 'Ower',
                'name_zh' => '运营组',
                'name_jp' => '运营组',
                'description'  => '运营组角色',
            ],[
                'name' => 'Addy',
                'name_zh' => '推广部',
                'name_jp' => '推广部',
                'description'  => '推广部角色',
            ],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::firstOrcreate($role);
        }

    }

    /**
     * @name        makePermission
     * @DateTime    ${DATE}
     * @param       \Illuminate\Http\Request.
     * @return      null
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function makePermission (){

        $permissions = [
            [
                'name' => 'permission',
                'name_jp' => '权限管理',
                'name_zh' => '权限管理',
                'child' => [
                    [
                        'name' => 'permissions.create',
                        'name_jp' => '新增权限',
                        'name_zh' => '新增权限',
                        'display_name' => 'permissions.create',

                    ],[
                        'name' => 'permissions.index',
                        'name_jp' => '权限列表',
                        'name_zh' => '权限列表',
                        'display_name' => 'permissions.index',
                    ],[
                        'name' => 'permissions.edit',
                        'name_jp' => '编辑权限',
                        'name_zh' => '编辑权限',
                        'display_name' => 'permissions.edit',
                        'type' => 1
                    ],[
                        'name' => 'permissions.destroy',
                        'name_jp' => '删除权限',
                        'name_zh' => '删除权限',
                        'display_name' => 'permissions.destroy',
                        'type' => 1
                    ],
                ]
            ],
            [
                'name' => 'user',
                'name_jp' => '用户管理',
                'name_zh' => '用户管理',
                'child' => [
                    [
                        'name' => 'users.create',
                        'name_jp' => '新增用户',
                        'name_zh' => '新增用户',
                        'display_name' => 'users.create',
                    ],[
                        'name' => 'users.index',
                        'name_jp' => '用户列表',
                        'name_zh' => '用户列表',
                        'display_name' => 'users.index',
                    ],[
                        'name' => 'users.edit',
                        'name_jp' => '编辑用户',
                        'name_zh' => '编辑用户',
                        'display_name' => 'users.edit',
                        'type' => 1
                    ],[
                        'name' => 'users.destroy',
                        'name_jp' => '删除用户',
                        'name_zh' => '删除用户',
                        'display_name' => 'users.destroy',
                        'type' => 1
                    ],
                ]
            ],
            [
                'name' => 'roles',
                'name_jp' => '角色管理',
                'name_zh' => '角色管理',
                'child' => [
                    [
                        'name' => 'roles.create',
                        'name_jp' => '新增角色',
                        'name_zh' => '新增角色',
                        'display_name' => 'roles.create',
                    ],[
                        'name' => 'roles.index',
                        'name_jp' => '角色列表',
                        'name_zh' => '角色列表',
                        'display_name' => 'roles.index',
                    ],[
                        'name' => 'roles.destroy',
                        'name_jp' => '删除角色',
                        'name_zh' => '删除角色',
                        'display_name' => 'roles.destroy',
                        'type' => 1
                    ],
                ]
            ],
        ];

        foreach ($permissions as $permission) {
            $permissionId = \App\Models\Permission::insertGetId([
                'name_zh' => $permission['name_zh'],
                'name_jp' => $permission['name_jp'],
                'name' => $permission['name'],
            ]);
            foreach ($permission['child'] as $item) {
                \App\Models\Permission::firstOrCreate([
                    'pid' => $permissionId ,
                    'name_zh'       => $item['name_zh'],
                    'name_jp'       => $item['name_jp'],
                    'name'          => $item['name'],
                    'display_name'  => $item['display_name'],
                    'type'          => isset($item['type']) ?: 0,
                ]);
            }

        }
    }
}
