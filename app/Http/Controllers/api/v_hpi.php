<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class v_hpi extends Controller
{
    public function show($id)
    {
        $result = DB::table('h_visit_hpi')
                ->where('h_vn',$id)
                ->orderby('h_entry_time','ASC')
                ->get();
        return response()->json($result);
    }
}
