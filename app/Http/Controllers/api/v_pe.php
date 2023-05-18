<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class v_pe extends Controller
{
    public function show($id)
    {
        $result = DB::table('h_visit_pe')
                ->where('pe_vn',$id)
                ->get();
        return response()->json($result);
    }
}
