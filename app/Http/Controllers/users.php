<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
class users extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function list()
    {
        $user = DB::table('users')
                ->join('u_perm','perm_id','users.permission')
                ->join('hos','h_code','users.pcucode')
                ->get();
        $perm = DB::table('u_perm')->get();
        return view('config.user.list',['user'=>$user,'perm'=>$perm]);
    }

    public function add(Request $request)
    {
        $perm = DB::table('u_perm')->where('perm_id',$request->permission)->first();
        DB::table('users')->insert(
            [
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'permission' => $request->permission,
            ]
        );
        return back()->with('success','ลงทะเบียนผู้ใช้งานเรียบร้อย : '.$request->name." :: ".$perm->perm_name);
    }
}
