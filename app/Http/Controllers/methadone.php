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

    public function list($id)
    {
        $status_id = base64_decode($id);
        if($status_id == 0){
            return redirect()->route('met.index');
        }else{
            $patient = DB::table('patient')
                ->join('patient_program','patient_program.patient_hn','patient.patient_hn')
                ->join('patient_status','patient_status.status_id','patient.patient_status')
                ->join('hos','hos.h_id','patient.patient_hdrug')
                ->where('patient_program.program_id', 2)
                ->where('patient.patient_status', $status_id)
                ->get();
                
            return view('clinic.fahwanmai.methadone.index',['patient'=>$patient]);
        }
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

    public function drug(Request $request,$id)
    {
        DB::table('patient')->where('patient_id', $id)->update(
            [
                'patient_hdrug' => $request->hdrug,
            ]
        );
        return back()->with('success','เปลี่ยนหน่วยบริการเรียบร้อย');
    }
}
