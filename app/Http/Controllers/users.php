<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class users extends Controller
{
    public function list()
    {
        $user = DB::table('users')
                ->join('u_perm','perm_id','users.permission')
                ->get();
        return view('config.user.list',['user'=>$user]);
    }
}
