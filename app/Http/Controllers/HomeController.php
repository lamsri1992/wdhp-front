<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::select("SELECT hos.h_name,h_visit.pcucode,hos.h_his,COUNT(*) AS total,MAX(h_visit.v_created) AS last_update,MAX(h_visit.visitdate) AS last_visit
                FROM h_visit
                LEFT JOIN hos ON hos.h_code = h_visit.pcucode
                GROUP BY pcucode
                ORDER BY total DESC");
        return view('index',['data'=>$data]);
    }

    public function apiCheck()
    {
        $hcode = Auth::user()->pcucode;
        $ihos = DB::table('hos')->where('h_code',$hcode)->first();
        $patient = DB::table('h_patient')->where('pcucodeperson',$hcode)->count();
        $visit = DB::table('h_visit')->where('pcucode',$hcode)->count();
        $diag = DB::table('h_visit_diag')->where('pcucode',$hcode)->count();
        $drug = DB::table('h_visit_drug')->where('pcucode',$hcode)->count();
        $lab = DB::table('h_visit_lab')->where('pcucode',$hcode)->count();
        $last = DB::table('h_visit')->where('pcucode',$hcode)->max('visitdate');
        
        return view('servicepoint.api',['ihos'=>$ihos,'patient'=>$patient,'visit'=>$visit,'diag'=>$diag,'drug'=>$drug,'lab'=>$lab,'last'=>$last]);
    }
}
