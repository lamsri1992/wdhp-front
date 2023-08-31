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
        $score = DB::table('risk_score')->get();
        $iscore = DB::table('h_anc_risk_level')->where('person_anc_id',$id)->first();
        return view('clinic.anc.show',['id'=>$id,'risk'=>$risk,'plan'=>$plan,'score'=>$score,'iscore'=>$iscore]);
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

    public function risk_level(Request $request, $id)
    {
        $check = DB::table('h_anc_risk_level')->where('person_anc_id',$id)->first();
        if(!isset($check)){
            DB::table('h_anc_risk_level')->insert([
                'person_anc_id' => $id,
                'person_level_id' => $request->val
            ]);
        }else{
            DB::table('h_anc_risk_level')->where('person_anc_id', $id)->update([
                'person_anc_id' => $id,
                'person_level_id' => $request->val
            ]);
        }
    }
}