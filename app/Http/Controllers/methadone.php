<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class methadone extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $patient = DB::table('patient')
            ->join('patient_program','patient_program.patient_hn','patient.patient_hn')
            ->join('patient_status','patient_status.status_id','patient.patient_status')
            ->join('hos','hos.h_id','patient.patient_hdrug')
            ->where('patient_program.program_id', 2)
            ->get();
            
        return view('clinic.fahwanmai.methadone.index',['patient'=>$patient]);
    }

    public function therapy($id)
    {
        $patient = DB::table('patient')
                ->join('hos','hos.h_id','patient.patient_hdrug')
                ->where('patient_id', $id)
                ->first();
        $hos = DB::table('hos')->get();
        return view('clinic.fahwanmai.methadone.therapy',['patient'=>$patient,'hos'=>$hos]);
    }
}
