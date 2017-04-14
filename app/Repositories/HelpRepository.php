<?php
namespace App\Repositories;


use App\Models\Permission;

class HelpRepository{

    public static function getMenu(){
//        if( ! \Auth::check() )
//        {
//            return [];
//        }

        $permissions = Permission::where('status',0)->where('type',0)->where('pid',0)->get();
        return $permissions;
    }

}