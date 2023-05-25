<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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

    public function list($id)
    {
        $clinic = DB::table('h_clinic')->where('clinic_id','0'.$id)->first();
        $result = DB::table('h_patient')
                ->join('h_clinic_list','h_clinic_list.list_hn','h_patient.hcode')
                ->join('hos','h_clinic_list.pcucode','hos.h_code')
                ->where('h_clinic_list.clinic_id', '0'.$id)
                ->orderBy('list_id','DESC')
                ->get();
        return view('clinic.ncd.list',['result'=>$result,'clinic'=>$clinic]);
    }

    public function send(Request $request, $id)
    {
        $hos = $request->get('formData');
        $date = date("Y-m-d");
        DB::table('h_clinic_list')->where('list_id', $id)->update(
            [
                'pcucode' => $hos,
                'senddate' => $date,
            ]
        );
    }
}
