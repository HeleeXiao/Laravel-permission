<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\User;
use App\Repositories\HelpRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
        view()->share('manage',true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $users = User::where('id','>',0);
        if($request->has('keywords'))
        {
            if($request->input('keywords') != "")
            {
                $users = $users->where('name','like',"%".e($request->input('keywords'))."%");
                $users = $users->orWhere('email','like',"%".e($request->input('keywords'))."%");
                $users = $users->orWhere('landing_ip','like',"%".e($request->input('keywords'))."%");
            }
        }
        $users = $users->paginate($request->input('l')?:10);
        return view('user.list',[
            'users'=>$users,
            'request'=>$request,
            'layui' => true
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
                bcrypt(trim($request->input('password'))) : 123456;
            $user->status = $request->input('status');
            $user->save();
            $user->attachRole($request->input('role_id'));
            DB::commit();
            return redirect('/users')->with('message','操作成功！')->with('status',200);
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
        $this->validate($request,[
            'name' => "required|string",
            'email' => "required|email",
            'role_id' => "required",
        ],[
            'name.required' => "请务必填写该数据",
            'email.required' => "请务必填写该数据",
            'role_id.required' => "请务必选择角色",
        ]);
//        dd($request->all());
        try{
            DB::beginTransaction();
            $user = User::find($request->input('user_id'));
            /*
             * 判断是否有修改的数据
             */
            $updateNull = true; //判断有无基本数据修改需求的变量
            $updateRole = true; //判断有无所属角色修改需求的变量
            $afterRole  = false;//判断有无所属角色的变量
            if(e($request->input('name')) == $user->name && $request->input('email') == $user->email &&
                 $user->status == $request->input('status') ){
                $updateNull = false;
            }
            if($user->roles->count()){
                $request->input('role_id') == $user->roles[0]->id ? $updateRole = false : true;
                $afterRole  = true;
            }{
                $updateRole = true;
            }
            if( !$updateNull && !$updateRole ){
                return back()->with('message','没有需要修改的数据!')->with('status', 202)->withInput();
            }
            $user->name = e($request->input('name'));
            $user->email = $request->input('email');
            $user->status = $request->input('status');
            $save = $user->save();
                if($afterRole){
                    if($request->input('role_id') != $user->roles[0]->id)
                    {
                        $user->detachRole($user->roles[0]->id);
                    }
                }
                $user->attachRole($request->input('role_id'));
            if(! $save ){
                DB::rollBack();
                return back()->with("message",'操作失败，请重新尝试!')->with('status',203);
            }
            DB::commit();
            return redirect('/users')->with("message", '操作成功!')->with('status', 200);
        }catch (\Exception $e){
            \Log::error('修改用户信息失败'.$e->getMessage().'\n'.$e->getFile().$e->getLine());
            DB::rollBack();
            return back()->with("message",'操作失败，请重新尝试!')->with('status',203);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $delete = User::where( ['id'=>$id] )->delete();
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
