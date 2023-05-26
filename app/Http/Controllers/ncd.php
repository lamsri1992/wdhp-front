<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ncd extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = DB::select('SELECT h_clinic.clinic_id,h_clinic.clinic_name,COUNT(h_clinic_list.list_id) AS total
                FROM h_clinic_list
                LEFT JOIN h_clinic ON h_clinic.clinic_id = h_clinic_list.clinic_id
                WHERE h_clinic.active = "Y"
                GROUP BY h_clinic.clinic_id');
        return view('clinic.ncd.index',['data'=>$data]);
    }

    public function all($id)
    {
        $clinic = DB::table('h_clinic')->where('clinic_id','0'.$id)->first();
        $result = DB::table('h_patient')
                ->join('h_clinic_list','h_clinic_list.list_hn','h_patient.hcode')
                ->join('hos','h_clinic_list.pcucode','hos.h_code')
                ->where('h_clinic_list.clinic_id', '0'.$id)
                // ->where('h_clinic_list.pcucode', Auth::user()->pcucode)
                // ->where('h_clinic_list.apv_status', 1)
                ->orderBy('list_id','DESC')
                ->get();
        $incase = DB::table('h_clinic_list')
                ->join('h_patient','h_patient.hcode','h_clinic_list.list_hn')
                ->where('h_clinic_list.pcucode', Auth::user()->pcucode)
                ->where('h_clinic_list.apv_status', 0)
                ->where('h_clinic_list.clinic_id', '0'.$id)
                ->get(); 
        return view('clinic.ncd.all',['result'=>$result,'clinic'=>$clinic,'incase'=> $incase]);
    }

    public function list($id)
    {
        $clinic = DB::table('h_clinic')->where('clinic_id','0'.$id)->first();
        $result = DB::table('h_patient')
                ->join('h_clinic_list','h_clinic_list.list_hn','h_patient.hcode')
                ->join('hos','h_clinic_list.pcucode','hos.h_code')
                ->where('h_clinic_list.clinic_id', '0'.$id)
                ->where('h_clinic_list.pcucode', Auth::user()->pcucode)
                ->where('h_clinic_list.apv_status', 1)
                ->orderBy('list_id','DESC')
                ->get();
        $incase = DB::table('h_clinic_list')
                ->join('h_patient','h_patient.hcode','h_clinic_list.list_hn')
                ->where('h_clinic_list.pcucode', Auth::user()->pcucode)
                ->where('h_clinic_list.apv_status', 0)
                ->where('h_clinic_list.clinic_id', '0'.$id)
                ->get(); 
        return view('clinic.ncd.list',['result'=>$result,'clinic'=>$clinic,'incase'=> $incase]);
    }

    public function send(Request $request, $id)
    {
        $hos = $request->get('formData');
        $date = date("Y-m-d");
        DB::table('h_clinic_list')->where('list_id', $id)->update(
            [
                'pcucode' => $hos,
                'senddate' => $date,
                'apv_status' => 0,
            ]
        );
    }

    public function approve(Request $request, $id)
    {
        $date = date("Y-m-d");
        DB::table('h_clinic_list')
            ->where('pcucode', Auth::user()->pcucode)
            ->where('clinic_id', '0'.$id)
            ->update(
            [
                'apv_status' => 1,
                'apv_date' => $date,
            ]
        );
    }

    public function report(Request $request)
    {
        $clinic = DB::table('h_clinic')->where('clinic_id',"0".$request->repname)->first();
        $data = DB::table('h_visit_diag')
                ->join('h_visit','h_visit.visitno','h_visit_diag.visitno')
                ->where('h_visit_diag.diagcode', 'like', '%'.$clinic->icd10.'%')
                ->whereBetween('h_visit_diag.visitdate', [$request->dstart, $request->dended])
                ->get();
        dd($clinic,$data);
    }

}
