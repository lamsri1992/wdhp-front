<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;

class visit extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $patient = DB::table('h_patient')->count();
        $unconfirmed = DB::table('h_patient')->where('consent_status', 1)->count();
        $confirm = DB::table('h_patient')->where('consent_status', 2)->count();
        $denied = DB::table('h_patient')->where('consent_status', 3)->count();
        return view('visit.index',['patient' => $patient,'confirm' => $confirm,'unconfirmed' => $unconfirmed,'denied' => $denied]);
    }

    public function search(Request $request)
    {
        $result = DB::table('h_patient')
                ->join('hos','hos.h_code','h_patient.pcucodeperson')
                ->join('p_sex','p_sex.sex_id','h_patient.sex')
                ->join('consent','consent.con_id','h_patient.consent_status')
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
        $patient = DB::table('h_patient')
            ->join('consent','consent.con_id','h_patient.consent_status')
            ->where('idcard',$cid)->first();
        return view('visit.list',['patient'=>$patient]);
    }

    public function consent($id)
    {   
        $cid = base64_decode($id);
        $patient = DB::table('h_patient')
            ->join('consent','consent.con_id','h_patient.consent_status')
            ->join('hos','hos.h_code','h_patient.pcucodeperson')
            ->where('idcard',$cid)->first();
        return view('visit.consent',['patient'=>$patient]);
    }

    public function confirm(Request $request,$id)
    {   
        $img = $request->image;
        if(empty($img)){
            return back()->with('error','ไม่พบรูปภาพ กรุณาลองใหม่อีกครั้ง');
        }else{
            $patient = DB::table('h_patient')->where('id',$id)->first();
            $cid = base64_encode($patient->idcard);
            
            $folderPath = "public/uploads/"; 
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = $patient->idcard . '.png';
            
            $file = $folderPath . $fileName;
            Storage::put($file, $image_base64);


            DB::table('h_patient')->where('idcard',$patient->idcard)->update(
                [ 
                    "consent_status" => 2,
                    "consent_approve" => Auth::user()->name,
                    "consent_approve_date" => date('Y-m-d'),
                ]
            );
            return redirect()->route('visit.list', ['id' => $cid]);
        }
    }
}
