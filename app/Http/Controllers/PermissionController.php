<?php

namespace App\Http\Controllers;

use App\Models\PermissionRole;
use App\Repositories\HelpRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;
use App\Models\Role;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::where('status',0);
        if($request->has('type')){
            $permissions = $permissions->where('type',intval($request->input('type')));
        }
        $permissions = $permissions->paginate($request->input('limit')?:config('project.list.limit'));
        return view('permission.list',['list' => $permissions,'request'=>$request]);
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
            'name' => "required|string|unique:permissions",
            'display_name' => "required|string|unique:permissions",
            'role_id' => "required",
            'pid' => "required",
        ],[
            'name.required' => "请务必填写该数据",
            'pid.required' => "请务必选择有无父级",
            'role_id.required' => "请务必选择所属组",
            'name.unique'   => "已经存在该数据，清修改",
            'display_name.unique'   => "已经存在该数据，清修改",
            'display_name.required' => "清务必填写该数据",
        ]);
        DB::beginTransaction();
        try {

            if ( ! \Route::has($request->display_name) && $request->pid != 0)
            {
                DB::rollBack();
                return back()->with("message",'不存在该别名!')->with('status',203)->withInput();
            }

            $permission = new Permission;
            $permission->name = trim($request->name);
            $permission->display_name = trim($request->display_name);
            $permission->status = trim($request->status);
            $permission->pid = trim($request->pid);
            $permission->type = trim($request->type);
            $permission->description = $request->has("description") ? trim($request->description) : "";
            $permission->save();
            $permission_id = $permission->id;
            $role_id = trim($request->input("role_id"));
            $role = Role::find($role_id);

            if ($permission_id) {
                if( PermissionRole::where('role_id',$role_id)->where('permission_id',$permission_id)->count() ){
                    DB::rollBack();
                    return back()->with("message",'存在相同数据，添加失败!')->with('status',203)->withInput();
                }
                $role->attachPermission($permission);
                DB::commit();
                return back()->with("message", '添加成功!')->with('status', 200)->withInput();
            }
            DB::rollBack();
            return back()->with("message",'添加失败!')->with('status',203)->withInput();
        }catch (\Exception $e){
            Log::error('添加权限失败'.$e);
            DB::rollBack();
            return back()->with("message",'添加失败!')->with('status',203)->withInput();
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
            'name' => "required|string",
            'display_name' => "required|string",
        ],[
            'name.required' => "清务必填写该数据",
            'display_name.required' => "清务必填写该数据",
        ]);
        $update = [];
        try{
            foreach (Permission::where('id',$id)->first()->toArray() as $key=>$value)
            {
                if(in_array($key,['id','created_at','updated_at'])){
                    continue;
                }
                if($value != $request->input($key))
                {
                    $update = array_merge($update,[$key=>$request->input($key)]);
                }
            }
            if($update){
                if(Permission::where('id',$id)->update($update))
                {
                    DB::commit();
                    return back()->with("message", '操作成功!')->with('status', 200);
                }
            }
            return back()->with('message','没有需要修改的数据!')->with('status', 202);
        }catch (\Exception $e){
            Log::error('修改权限失败'.$e->getMessage());
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
