<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
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
    public function index()
    {
        $roles = Role::where('status',0)->get();
        $permissions = Permission::where('status',0)->get();
        return view('role.list',['roles'=>$roles,'permissions'=>$permissions,'layui'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::where('status',0)->get();
        return view('role.add',[
            'permissions'=>$permissions
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
            'name' => "required|string|unique:roles",
            'name_zh' => "required|string|unique:roles",
            'name_jp' => "required|string|unique:roles",
            'permission_id' => "required",
        ],[
            'name.required' => "请务必填写该数据",
            'name_zh.required' => "请务必填写该数据",
            'name_jp.required' => "请务必填写该数据",
            'permission_id.required' => "请务必选择其包含的权限",
            'name.unique'      => "已经存在该数据，请修改",
            'name_zh.unique'   => "已经存在该数据，请修改",
            'name_jp.unique'   => "已经存在该数据，请修改",
        ]);
        try{
            DB::beginTransaction();
            $roles = Role::create([
                'name' => e($request->input('name')),
                'name_zh' => e($request->input('name_zh')),
                'name_jp' => e($request->input('name_jp')),
                'description' => e($request->input('description')),
            ]);
            if($roles){
                foreach ($request->input('permission_id') as $permission_id) {
                    $roles->attachPermission($permission_id);
                }
                DB::commit();
                return back()->with("message", '添加成功!')->with('status', 200)->withInput();
            }
            DB::rollBack();
            return back()->with("message",'添加失败,请重新尝试!')->with('status',203)->withInput();
        }catch (\Exception $e){
            \Log::error('添加角色失败'.$e);
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
        //
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
        $thisRole = Role::where('id',$id)->first();
        $originalPerms = $thisRole->perms->pluck('id')->toArray();
        $nowPerms = $request->input('permissions');
        $delete = [];
        $insert = [];
        foreach ($originalPerms as $perm)
        {
            if( ! in_array($perm , $nowPerms) )
            {
                array_push($delete,$perm);
            }
        }
        foreach ($nowPerms as $perm)
        {
            if( ! in_array($perm , $originalPerms) )
            {
                array_push($insert,$perm);
            }
        }
        foreach ($insert as $value)
        {
            $thisRole->attachPermission($value);
        }
        foreach ($delete as $value)
        {
            $thisRole->detachPermission($value);
        }
        return back()->with("message",'操作成功!')->with('status',200)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
