<?php
namespace App\Repositories;


use App\Models\Permission;

class HelpRepository{

    /**
     * @name        getMenu
     * @param       none
     * @return      Array
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public static function getMenu(){
        $permissions = Permission::where('status',0)->where('type',0)->get();
        $parentPermission = [];
        $childPermission = [];
        foreach ($permissions as $permission) {
            if(!$permission->pid)
            {
                array_push($parentPermission,$permission->toArray());
            }else{
                array_push($childPermission,$permission->toArray());
            }
        }
        foreach ($childPermission as $permission) {
            foreach ($parentPermission as $key => $parent) {
                if($permission['pid'] == $parent['id'])
                {
                    $parentPermission[$key]['children'][] = $permission;
                }
            }
        }
        return $parentPermission;
    }

}