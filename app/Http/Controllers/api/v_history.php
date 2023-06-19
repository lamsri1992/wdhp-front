<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class v_history extends Controller
{
    public function show($id)
    {
        $patient = DB::table('h_patient')
                ->where('idcard',$id)
                ->first();
        $hospital = DB::table('h_patient')
                ->select('pcucodeperson')
                ->where('idcard',$id)
                ->get();
        $newArray = $hospital->map(function($item){
            return $item->pcucodeperson;
        })->toArray();
        $in_array = "'".implode("','",$newArray)."'";
        $history = DB::select(DB::raw(
           "SELECT DISTINCT h_visit.visitno, h_visit.visitdate, h_visit.pid, idcard, hcode, h_code, h_name, h_color 
            FROM h_visit 
            LEFT JOIN h_patient ON h_patient.pid = h_visit.pid 
            LEFT JOIN hos ON hos.h_code = h_visit.pcucode 
            WHERE h_visit.pid = '$patient->pid'
            AND h_visit.pcucode IN ($in_array)
            GROUP BY h_visit.visitno
            ORDER BY h_visit.visitdate DESC"));
        return response()->json($history);
    }
}
