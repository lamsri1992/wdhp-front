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
        $cid = '0'.$id;
        $clinic = DB::table('h_clinic')->where('clinic_id',$cid)->first();
        $result = DB::table('h_patient')
                ->join('h_clinic_list','h_clinic_list.list_hn','h_patient.hcode')
                ->join('hos','h_clinic_list.pcucode','hos.h_code')
                ->where('h_clinic_list.clinic_id', $cid)
                ->orderBy('list_id','DESC')
                ->get();
        $incase = DB::table('h_clinic_list')
                ->join('h_patient','h_patient.hcode','h_clinic_list.list_hn')
                ->where('h_clinic_list.pcucode', Auth::user()->pcucode)
                ->where('h_clinic_list.apv_status', 0)
                ->where('h_clinic_list.clinic_id', $cid)
                ->get();
        $count = DB::select("SELECT hos.h_name,COUNT(h_clinic_list.list_id) AS total
                FROM h_clinic_list
                LEFT JOIN hos ON hos.h_code = h_clinic_list.pcucode
                WHERE h_clinic_list.clinic_id = $cid
                GROUP BY hos.h_code");
        return view('clinic.ncd.all',['result'=>$result,'clinic'=>$clinic,'incase'=> $incase,'count'=> $count]);
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
                'apv_date' => NULL,
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
                ->select('h_visit_diag.visitdate','h_visit_diag.visitno','h_visit_diag.diagcode','h_visit_diag.diseasenamethai','h_visit.pid',
                'h_patient.hcode','h_patient.prename','h_patient.fname','h_patient.lname','h_visit.pressure','h_visit_lab.v_lab_name','h_visit_lab.v_lab_result')
                ->leftjoin('h_visit','h_visit.visitno','h_visit_diag.visitno')
                ->leftjoin('h_patient','h_patient.pid','h_visit.pid')
                ->leftjoin('h_visit_lab','h_visit_lab.v_lab_vn','h_visit_diag.visitno')
                ->where('h_visit_diag.diagcode', 'like', '%'.$clinic->icd10.'%')
                ->where('h_visit_lab.v_lab_name', 'like', '%FBS%')
                ->whereBetween('h_visit_diag.visitdate', [$request->dstart, $request->dended])
                ->get();
        dd($clinic,$data);
    }

    public function consult()
    {
       return view('clinic.ncd.consult');
    }

}
