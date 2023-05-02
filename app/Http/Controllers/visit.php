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
        $result = DB::table('h_patient')
                ->join('hos','hos.h_code','h_patient.pcucodeperson')
                ->join('p_sex','p_sex.sex_id','h_patient.sex')
                ->orwhere('h_patient.hcode',$request->s_keys)
                ->orwhere('h_patient.idcard',$request->s_keys)
                ->orwhere('h_patient.fname',$request->s_keys)
                ->orwhere('h_patient.lname',$request->s_keys)
                ->get();
        return view('visit.result',['result'=>$result]);
    }

    public function list(Request $request,$id)
    {   
        $cid = base64_decode($id);
        $patient = DB::table('h_patient')->where('idcard',$cid)->first();
        return view('visit.list',['patient'=>$patient]);
    }
}
