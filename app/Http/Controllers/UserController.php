<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $users = User::paginate($request->input('limit')?:config('project.list.limit'));

        return view('user.list',[
            'users'=>$users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status',0)->get();
        return view('user.add',['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'name' => "required|string|unique:users",
            'email' => "required|email|unique:users",
//            'password' => "sometimes|min:6|max:12",
        ],[
            'name.required' => "请务必填写姓名",
            'name.unique'   => "已经存在该用户名，清修改",
            'email.required'   => "请务必填写邮箱📮",
            'email.unique'   => "已经存在该邮箱📮，清修改",
            'email.email'   => "请确认您填写的📮格式",
//            'password.min' => "密码长度不得少于6位",
//            'password.max' => "密码长度不得大于12位",
        ]);
        if( $validator->fails() )
        {
            return back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try{
            $user = new User;
            $user->name = e(trim($request->input('name')));
            $user->email = e(trim($request->input('email')));
            $user->password = $request->has('password') ?
                bcrypt(trim($request->input('password'))) : bcrypt(123456);
            $user->status = $request->input('status');
            $user->save();
            $user->attachRole($request->input('role_id'));
            DB::commit();
            return back()->with('message','操作成功！')->with('status',200);
        }catch (\Exception $e)
        {
            DB::rollBack();
            \Log::error("添加用户失败".$e->getMessage());
            return back()->with('message','操作失败!')->with('status',203);
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
        $info = User::find($id);
        return view('user.edit',[
            'info'=>$info,
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
        //
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
