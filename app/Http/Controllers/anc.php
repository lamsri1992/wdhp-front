<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class anc extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('clinic.anc.index');
    }

    public function show($id)
    {
        $risk = DB::table('h_anc_risk')->where('person_anc_id',$id)->get();
        $plan = DB::table('h_anc_plan')->where('person_anc_id',$id)->get();
        return view('clinic.anc.show',['id'=>$id,'risk'=>$risk,'plan'=>$plan]);
    }

    public function report(Request $request)
    {
        $dstart = $request->dstart;
        $dended = $request->dended;
        return view('clinic.anc.report',['dstart'=>$dstart,'dended'=>$dended]);
    }

    public function risk(Request $request, $id)
    {
        if($request->type == 1){
            DB::table('h_anc_risk')->insert([
                'risk_text' => $request->formData,
                'person_anc_id' => $id
            ]);
        }else{
            DB::table('h_anc_plan')->insert([
                'plan_text' => $request->formData,
                'person_anc_id' => $id
            ]);
        }
    }
}