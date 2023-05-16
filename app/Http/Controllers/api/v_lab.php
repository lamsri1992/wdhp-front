<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class v_lab extends Controller
{
    public function show($id)
    {
        $result = DB::table('h_visit_lab')
                ->where('v_lab_vn',$id)->get();
        return response()->json($result);
    }
}
