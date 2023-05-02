<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class v_drug extends Controller
{
    public function show($id)
    {
        $result = DB::table('h_visit_drug')
                ->where('drugname','!=',NULL)
                ->where('visitno',$id)->get();
        return response()->json($result);
    }
}
