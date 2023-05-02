<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class v_ccpi extends Controller
{
    public function show($id)
    {
        $result = DB::table('h_visit')->where('visitno',$id)->get();
        return response()->json($result);
    }
}
