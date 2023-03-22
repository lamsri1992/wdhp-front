<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class visit extends Controller
{
    public function list()
    {
        $hos = DB::table('hos')->get();
        return view('visit.list',['hos'=>$hos]);
    }
}
