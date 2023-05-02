<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class v_history extends Controller
{
    public function show($id)
    {
        $patient = DB::table('h_patient')->where('idcard',$id)->first();
        $history = DB::table('h_visit')
                ->select('visitdate','visitno','pid','h_code','h_name','h_color')
                ->where('pid',$patient->pid)
                ->join('hos','hos.h_code','h_visit.pcucode')
                ->orderby('visitdate','desc')
                ->get();
        return response()->json($history);
    }
}
