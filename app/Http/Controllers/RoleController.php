<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
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
