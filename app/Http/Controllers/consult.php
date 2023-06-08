<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class consult extends Controller
{
    public function list()
    {
        $tall = DB::table('h_consult')->count();
        $wait = DB::table('h_consult')->where('cn_status',1)->count();
        $read = DB::table('h_consult')->where('cn_status',2)->count();
        $answ = DB::table('h_consult')->where('cn_status',3)->count();

        $data = DB::table('h_consult')
                ->leftjoin('hos','hos.h_code','h_consult.pcucode')
                ->leftjoin('consult_status','consult_status.st_id','h_consult.cn_status')
                ->get();
        return view('consult.list',['data'=>$data,'tall'=>$tall,'wait'=>$wait,'read'=>$read,'answ'=>$answ]);
    }

    public function show($id)
    {
        $respon = Auth::user()->name;
        $data = DB::table('h_consult')
                ->leftjoin('hos','hos.h_code','h_consult.pcucode')
                ->where('id',$id)
                ->first();

        $ovst = DB::table('h_consult_visit')
                ->where('visitno',$data->vstno)
                ->where('pcucode',$data->pcucode)
                ->first();

        $diag = DB::table('h_consult_diag')
                ->where('visitno',$data->vstno)
                ->where('pcucode',$data->pcucode)
                ->get();
        
        $drug = DB::table('h_consult_drug')
                ->where('visitno',$data->vstno)
                ->where('pcucode',$data->pcucode)
                ->get();
        
        $ptex = DB::table('h_patient')
                ->leftjoin('p_sex','p_sex.sex_id','h_patient.sex')
                ->where('pid',$ovst->pid)
                ->where('pcucodeperson',$data->pcucode)
                ->first();
        
        $answ = DB::table('h_consult_respon')
                ->where('cc_id',$id)
                ->first();
                
        if($data->cn_read == ""){
            DB::table('h_consult')->where('id',$id)->update(
                [
                    "cn_status" => 2,
                    "cn_read" => $respon
                ]
            );
        }

        return view('consult.show',['data'=>$data,'ovst'=>$ovst,'diag'=>$diag,'drug'=>$drug,'ptex'=>$ptex,'answ'=>$answ]);
    }

    public function answer(Request $request, $id)
    {
        $respon = Auth::user()->name;
        $data = DB::table('h_consult')->where('id',$id)->first();

        DB::table('h_consult_respon')->insert(
            [
                "cc_id" => $id,
                "cs_text" => $request->cn_txt,
                "cs_respon" => $respon
            ]
        );

        DB::table('h_consult')->where('id',$id)->update(
            [
                "cn_status" => 3,
                "cn_respon" => $respon
            ]
        );

        // Line Notify
        $Token = "pI7JcfdQyyebIrdHEeTnmFOwZVDXwath4Rl4CAhgiQ6";
        $message = "รายการตอบกลับ Consult \nรหัสหน่วยบริการ : ".$data->pcucode."\nVSTNO : ".$data->vstno."\nคำแนะนำจากแพทย์ : ".$request->cn_txt."\nผู้ตอบ : ".$request->cn_respon."
        \nURL : http://203.157.209.59/wdhp-front/consult/".$id."";
        line_notify($Token, $message);
        
        return back()->with('success','บันทึกรายการให้คำแนะนำสำเร็จ : '.$data->vstno."");
    }

}
