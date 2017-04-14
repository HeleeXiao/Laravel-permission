<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /** 获取父级权限
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parent()
    {
        return $this->belongsTo($this,'pid','id');
    }

    /**获取所属组
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany(Role::class,'permission_role');
    }

    /** 获取子级权限
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany($this,'pid','id');
    }

}
