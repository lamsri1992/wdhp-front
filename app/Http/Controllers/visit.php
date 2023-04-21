<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class visit extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('visit.index');
    }

    public function search(Request $request)
    {
        $result = DB::table('h_visit')
                ->select('v_id','visitno','visitdate','pcucode','h_name','prename','fname','lname','hcode')
                ->join('h_patient','h_patient.pid','h_visit.pid')
                ->join('hos','hos.h_code','h_visit.pcucode')
                ->orwhere('h_patient.hcode',$request->s_keys)
                ->orwhere('h_patient.idcard',$request->s_keys)
                ->orwhere('h_patient.fname',$request->s_keys)
                ->orwhere('h_patient.lname',$request->s_keys)
                ->get();
        return view('visit.result',['result'=>$result]);
    }
}
