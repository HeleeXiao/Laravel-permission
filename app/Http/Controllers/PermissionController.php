<?php

namespace App\Http\Controllers;

use App\Models\PermissionRole;
use App\Repositories\HelpRepository;
use App\Events\UpdatePermissionNameEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;
use App\Models\Role;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::where('status',0);
        if($request->has('keywords'))
        {
            if($request->input('keywords') != "")
            {
                $permissions = $permissions->Where('name_zh','like',"%".e($request->input('keywords'))."%");
                $permissions = $permissions->orWhere('name_jp','like',"%".e($request->input('keywords'))."%");
                $permissions = $permissions->orWhere('display_name','like',"%".e($request->input('keywords'))."%");
                $permissions = $permissions->orWhere('description','like',"%".e($request->input('keywords'))."%");
            }
        }
        if($request->has('type')){
            $permissions = $permissions->where('type',intval($request->input('type')));
        }
        $limit = $request->has('l') && in_array($request->input('l'),[5,10,20]) ?
                $request->input('l')  : 10;
        $permissions = $permissions->with('parent')->paginate($limit);
        return view('permission.list',['list' => $permissions,'request'=>$request,'layui'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status',0)->get();
        $parentPermission = Permission::where('pid',0)->where('status',0)->get();
        return view('permission.add',[
            'roles' => $roles,
            'parentPermission' => $parentPermission
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name_zh' => "required|string|unique:permissions",
            'name_jp' => "required|string|unique:permissions",
            'display_name' => "required|string|unique:permissions",
            'role_id' => "required",
            'pid' => "required",
        ],[
            'name_zh.required' => "请务必填写该数据",
            'name_jp.required' => "请务必填写该数据",
            'pid.required'     => "请务必选择有无父级",
            'role_id.required' => "请务必选择所属组",
            'name.unique'      => "已经存在该数据，请修改",
            'name_zh.unique'   => "已经存在该数据，请修改",
            'name_jp.unique'   => "已经存在该数据，请修改",
            'display_name.unique'   => "已经存在该数据，请修改",
        ]);
        DB::beginTransaction();
        try {
            if ( ! \Route::has($request->display_name) && $request->pid != 0 && $request->type != 1)
            {
                DB::rollBack();
                return back()->with("message",'不存在该别名!')->with('status',203)->withInput();
            }

            $permission = new Permission;
            $permission->name = trim($request->display_name);
            $permission->name_zh = trim($request->name_zh);
            $permission->name_jp = trim($request->name_jp);
            $permission->display_name = trim($request->display_name);
            $permission->status = trim($request->status);
            $permission->pid = trim($request->pid);
            $permission->type = trim($request->type);
            $permission->description = $request->has("description") ? trim($request->description) : "";
            $permission->save();
            $permission_id = $permission->id;
            $role_id = $request->input("role_id");

            if ($permission_id) {
                if( PermissionRole::whereIn('role_id',$role_id)->where('permission_id',$permission_id)->count() ){
                    DB::rollBack();
                    return back()->with("message",'存在重复数据，添加失败!')->with('status',203)->withInput();
                }

                /**
                 * 绑定权限到角色
                 */
                foreach ($role_id as $r_id) {
                    Role::find($r_id)->attachPermission($permission);
                }
                DB::commit();
                return redirect('/permissions')->with("message", '添加成功!')->with('status', 200)->withInput();
            }
            DB::rollBack();
            return back()->with("message",'添加失败!')->with('status',203)->withInput();
        }catch (\Exception $e){
            Log::error('添加权限失败'.$e);
            DB::rollBack();
            return back()->with("message",'添加失败,请重新尝试!')->with('status',203)->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::where('status',0)->get();
        $permission = Permission::find($id);

        $parentPermission = Permission::where('pid',0)->where('status',0)->get();
        view()->share('parentPermission',$parentPermission);
        return view('permission.edit',[
            'permission'=>$permission,
            'roles'=>$roles,
            'id'=>$id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name_zh' => "required|string",
            'name_jp' => "required|string",
            'display_name' => "required|string|unique:permissions",
        ],[
            'name_zh.required' => "请务必填写该数据",
            'name_jp.required' => "请务必填写该数据",
            'display_name.required' => "请务必填写该数据",
            'display_name.unique'   => "已经存在该数据，请修改",
        ]);
        $update = [];
        try{
            DB::beginTransaction();
            $permission     = Permission::where('id',$id)->first();
            $originalRoles    = $permission->role;
            $nowRoles       = $request->input("role_id");
            if ( ! \Route::has($request->display_name) && $request->pid != 0)
            {
                DB::rollBack();
                return back()->with("message",'不存在该别名!')->with('status',203)->withInput();
            }
            foreach ($permission->toArray() as $key=>$value)
            {
                /**
                 * 过滤掉不在更新范围内的字段
                 */
                if(in_array($key,['id','created_at','updated_at','name','role'])){
                    continue;
                }
                /**
                 * 新值与过去值不同意则写入更新变量中，待更新
                 */
                if($value != $request->input($key))
                {
                    $update = array_merge($update,[$key=>$request->input($key)]);
                }
            }
            if($update){
                if(! Permission::where('id',$id)->update($update))
                {
                    return back()->with("message",'操作失败!')->with('status',203);
                }
            }
            $delete = [];
            $insert = [];
            $newInArrayOriginalRoles = [];
            /**
             * 检查被删除的关系
             */
            foreach ($originalRoles as $role)
            {
                $newInArrayOriginalRoles[] = $role->id;
                if( ! in_array($role->id , $nowRoles) )
                {
                    array_push($delete,$role->id);
                }
            }
            /**
             * 检查新增的关系
             */
            foreach ($nowRoles as $role)
            {
                if( ! in_array($role , $newInArrayOriginalRoles) )
                {
                    array_push($insert,$role);
                }
            }
            /**
             * 执行关系的新增与删除
             */
            if($insert || $delete)
            {
                foreach ($insert as $value)
                {
                    Role::find($value)->attachPermission($id);
                }
                foreach ($delete as $value)
                {
                    Role::find($value)->detachPermission($id);
                }
            }
            if(!$update && !$insert && !$delete)
            {
                return back()->with('message','没有需要修改的数据!')->with('status', 202)->withInput();
            }
            //触发事件  修改权限name为路由
            \Event::fire(new UpdatePermissionNameEvent($permission));
            DB::commit();
            return back()->with("message", '操作成功!')->with('status', 200);
        }catch (\Exception $e){
            Log::error('修改权限失败'.$e->getMessage().'\n'.$e->getFile().$e->getLine());
            DB::rollBack();
            return back()->with("message",'操作失败!')->with('status',203);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        DB::beginTransaction();
        try{
            $delete = Permission::where( ['id'=>$id] )->delete();
            if($delete){
                DB::commit();
                return back()->with("message", '操作成功!')->with('status', 200);
            }
            DB::rollBack();
            return back()->with("message",'操作失败!')->with('status',203);
        }catch (\Exception $e){
            Log::error('删除权限失败'.$e->getMessage());
            DB::rollBack();
            return back()->with("message",'操作失败!')->with('status',203);
        }
    }
}
