<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class methadone extends Controller
{
    public function index()
    {
        $patient = DB::table('patient')
            ->join('patient_program','patient_program.patient_hn','patient.patient_hn')
            ->join('patient_status','patient_status.status_id','patient.patient_status')
            ->where('patient_program.program_id', 2)
            ->get();
            
        return view('clinic.fahwanmai.methadone.index',['patient'=>$patient]);
    }

    public function therapy($id)
    {
        $patient = DB::table('patient')->where('patient_id', $id)->first();
        return view('clinic.fahwanmai.methadone.therapy',['patient'=>$patient]);
    }
}
