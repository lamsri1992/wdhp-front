<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class methadoneController extends Controller
{
    public function index()
    {
        $patient = DB::table('patient')
            ->join('patient_program','patient_program.patient_hn','patient.patient_hn')
            ->join('p_prefix','p_prefix.prefix_value','patient.patient_prefix')
            ->join('patient_status','patient_status.status_id','patient.patient_status')
            ->where('patient_program.program_id', 2)
            ->get();
        return view('narcotic.methadone.index',['patient'=>$patient]);
    }

    public function info($id)
    {
        $patient = DB::table('patient')
            ->leftJoin('c_matrix_info','c_matrix_info.info_patient_id','patient.patient_id')
            ->where('patient.patient_id', $id)
            ->first();
        $type_1 = DB::table('info_type')->where('type_group',1)->get();
        $type_2 = DB::table('info_type')->where('type_group',2)->get();
        $m_type = DB::table('martix_type')->get();
        return view('narcotic.methadone.info',['patient'=>$patient,'type_1'=>$type_1,'type_2'=>$type_2,'m_type'=>$m_type]);
    }

    public function addInfo(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'info_type' => 'required',
                'info_date_in' => 'required',
                'info_drug' => 'required',
                'info_drug_use' => 'required',
                'info_drug_time' => 'required',
                'info_drug_last' => 'required',
                'info_last_time' => 'required',
                'info_pi' => 'required',
            ],
            [
                'info_type.required' => 'กรุณาเลือกรูปแบบการบำบัด',
                'info_date_in.required' => 'กรุณาเลือกวันที่รับตัว',
                'info_drug.required' => 'กรุณาเลือกชนิดของสารเสพติดที่ใช้',
                'info_drug_use.required' => 'กรุณาระบุระยะเวลาที่ใช้สารเสพติด',
                'info_drug_time.required' => 'กรุณาเลือกระยะเวลาที่ใช้สารเสพติด',
                'info_drug_last.required' => 'กรุณาระบุระยะเวลาที่ใช้สารเสพติดล่าสุด',
                'info_last_time.required' => 'กรุณาเลือกระยะเวลาที่ใช้สารเสพติดล่าสุด',
                'info_pi.required' => 'กรุณาระบุหมายเหตุ หากไม่มีให้ใส่ -',
            ]
        );
        if($request->get('info_drug')){
            $arr_select = array();
            foreach($request->get('info_drug') as $info_drug){
                $arr_select[] = $info_drug;
            }
            $info_drugs = implode(",", $arr_select);
        }else{
            $info_drugs = "";
        }
        DB::table('c_matrix_info')->insert(
            [
                "info_patient_id" => $id,
                "info_type" => $request->get('info_type'),
                "info_date_in" => $request->get('info_date_in'),
                "info_age" => $request->get('info_age'),
                "info_drug" => $info_drugs,
                "info_drug_use" => $request->get('info_drug_use'),
                "info_drug_time" => $request->get('info_drug_time'),
                "info_drug_last" => $request->get('info_drug_last'),
                "info_last_time" => $request->get('info_last_time'),
                "info_pi" => $request->get('info_pi'),
            ]
        );
        $patient = DB::table('patient')->where('patient_id', $id)->first();
        return back()->with('success','เพิ่มข้อมูลการรับเข้าบำบัด : HN: '.$patient->patient_hn." ".$patient->patient_name);
    }

    public function updateInfo(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'info_type' => 'required',
                'info_date_in' => 'required',
                'info_drug' => 'required',
                'info_drug_use' => 'required',
                'info_drug_time' => 'required',
                'info_drug_last' => 'required',
                'info_last_time' => 'required',
                'info_pi' => 'required',
            ],
            [
                'info_type.required' => 'กรุณาเลือกรูปแบบการบำบัด',
                'info_date_in.required' => 'กรุณาเลือกวันที่รับตัว',
                'info_drug.required' => 'กรุณาเลือกชนิดของสารเสพติดที่ใช้',
                'info_drug_use.required' => 'กรุณาระบุระยะเวลาที่ใช้สารเสพติด',
                'info_drug_time.required' => 'กรุณาเลือกระยะเวลาที่ใช้สารเสพติด',
                'info_drug_last.required' => 'กรุณาระบุระยะเวลาที่ใช้สารเสพติดล่าสุด',
                'info_last_time.required' => 'กรุณาเลือกระยะเวลาที่ใช้สารเสพติดล่าสุด',
                'info_pi.required' => 'กรุณาระบุหมายเหตุ หากไม่มีให้ใส่ -',
            ]
        );
        if($request->get('info_drug')){
            $arr_select = array();
            foreach($request->get('info_drug') as $info_drug){
                $arr_select[] = $info_drug;
            }
            $info_drugs = implode(",", $arr_select);
        }else{
            $info_drugs = "";
        }
        DB::table('c_matrix_info')->where('info_patient_id',$id)->update(
            [
                "info_patient_id" => $id,
                "info_type" => $request->get('info_type'),
                "info_date_in" => $request->get('info_date_in'),
                "info_age" => $request->get('info_age'),
                "info_drug" => $info_drugs,
                "info_drug_use" => $request->get('info_drug_use'),
                "info_drug_time" => $request->get('info_drug_time'),
                "info_drug_last" => $request->get('info_drug_last'),
                "info_last_time" => $request->get('info_last_time'),
                "info_pi" => $request->get('info_pi'),
            ]
        );
        $patient = DB::table('patient')->where('patient_id', $id)->first();
        return back()->with('success','แก้ไขข้อมูลการรับเข้าบำบัด : HN: '.$patient->patient_hn." ".$patient->patient_name);
    }

    public function screen($id)
    {
        $patient = DB::table('patient')
            ->leftJoin('c_matrix_screen','c_matrix_screen.screen_patient_id','patient.patient_id')
            ->where('patient.patient_id', $id)
            ->first();
        $m_type = DB::table('martix_type')->get();
        return view('narcotic.methadone.screen',['patient'=>$patient,'m_type'=>$m_type]);
    }

    public function addScreen(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'screen_date' => 'required',
                'screen_place' => 'required',
                'screen_drug' => 'required',
                'screen_primary' => 'required',
                'screen_1' => 'required',
                'screen_2' => 'required',
                'screen_3' => 'required',
                'screen_4' => 'required',
                'screen_5' => 'required',
                'screen_6' => 'required',
                'screen_inject' => 'required',
            ],
            [
                'screen_date.required' => 'กรุณาเลือกวันที่คัดกรอง',
                'screen_place.required' => 'กรุณาระบุสถานที่คัดกรอง',
                'screen_drug.required' => 'กรุณาเลือกชนิดของสารเสพติดที่ใช้',
                'screen_primary.required' => 'กรุณาระบุยา และสารเสพติดหลักที่ใช้และคัดกรอง',
                'screen_1.required' => 'ระบุข้อที่ 1',
                'screen_2.required' => 'ระบุข้อที่ 2',
                'screen_3.required' => 'ระบุข้อที่ 3',
                'screen_4.required' => 'ระบุข้อที่ 4',
                'screen_5.required' => 'ระบุข้อที่ 5',
                'screen_6.required' => 'ระบุข้อที่ 6',
                'screen_inject.required' => 'ระบุการใช้สารเสพติดชนิดฉีด',
            ]
        );
        if($request->get('screen_drug')){
            $arr_select = array();
            foreach($request->get('screen_drug') as $screen_drug){
                $arr_select[] = $screen_drug;
            }
            $screen_drugs = implode(",", $arr_select);
        }else{
            $screen_drugs = "";
        }
        DB::table('c_matrix_screen')->insert(
            [
                "screen_patient_id" => $id,
                "screen_date" => $request->get('screen_date'),
                "screen_place" => $request->get('screen_place'),
                "screen_drug" => $screen_drugs,
                "screen_primary" => $request->get('screen_primary'),
                "screen_1" => $request->get('screen_1'),
                "screen_2" => $request->get('screen_2'),
                "screen_3" => $request->get('screen_3'),
                "screen_4" => $request->get('screen_4'),
                "screen_5" => $request->get('screen_5'),
                "screen_6" => $request->get('screen_6'),
                "screen_inject" => $request->get('screen_inject'),
                "screen_inject_note" => $request->get('screen_inject_note'),
                "screen_viewer" => $request->get('screen_viewer'),
            ]
        );
        $patient = DB::table('patient')->where('patient_id', $id)->first();
        return back()->with('success','บันทึกข้อมูลการคัดกรองแล้ว : HN: '.$patient->patient_hn." ".$patient->patient_name);
    }

    public function updateScreen(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'screen_date' => 'required',
                'screen_place' => 'required',
                'screen_drug' => 'required',
                'screen_primary' => 'required',
                'screen_1' => 'required',
                'screen_2' => 'required',
                'screen_3' => 'required',
                'screen_4' => 'required',
                'screen_5' => 'required',
                'screen_6' => 'required',
                'screen_inject' => 'required',
            ],
            [
                'screen_date.required' => 'กรุณาเลือกวันที่คัดกรอง',
                'screen_place.required' => 'กรุณาระบุสถานที่คัดกรอง',
                'screen_drug.required' => 'กรุณาเลือกชนิดของสารเสพติดที่ใช้',
                'screen_primary.required' => 'กรุณาระบุยา และสารเสพติดหลักที่ใช้และคัดกรอง',
                'screen_1.required' => 'ระบุข้อที่ 1',
                'screen_2.required' => 'ระบุข้อที่ 2',
                'screen_3.required' => 'ระบุข้อที่ 3',
                'screen_4.required' => 'ระบุข้อที่ 4',
                'screen_5.required' => 'ระบุข้อที่ 5',
                'screen_6.required' => 'ระบุข้อที่ 6',
                'screen_inject.required' => 'ระบุการใช้สารเสพติดชนิดฉีด',
            ]
        );
        if($request->get('screen_drug')){
            $arr_select = array();
            foreach($request->get('screen_drug') as $screen_drug){
                $arr_select[] = $screen_drug;
            }
            $screen_drugs = implode(",", $arr_select);
        }else{
            $screen_drugs = "";
        }
        DB::table('c_matrix_screen')->where('screen_patient_id',$id)->update(
            [
                "screen_patient_id" => $id,
                "screen_date" => $request->get('screen_date'),
                "screen_place" => $request->get('screen_place'),
                "screen_drug" => $screen_drugs,
                "screen_primary" => $request->get('screen_primary'),
                "screen_1" => $request->get('screen_1'),
                "screen_2" => $request->get('screen_2'),
                "screen_3" => $request->get('screen_3'),
                "screen_4" => $request->get('screen_4'),
                "screen_5" => $request->get('screen_5'),
                "screen_6" => $request->get('screen_6'),
                "screen_inject" => $request->get('screen_inject'),
                "screen_inject_note" => $request->get('screen_inject_note'),
                "screen_viewer" => $request->get('screen_viewer'),
            ]
        );
        $patient = DB::table('patient')->where('patient_id', $id)->first();
        return back()->with('success','แก้ไขข้อมูลการคัดกรองแล้ว : HN: '.$patient->patient_hn." ".$patient->patient_name);
    }

    public function depress($id)
    {
        $patient = DB::table('patient')
            ->leftJoin('c_maxtrix_depress','c_maxtrix_depress.dep_patient_id','patient.patient_id')
            ->where('patient.patient_id', $id)
            ->first();
        return view('narcotic.methadone.depress',['patient'=>$patient]);
    }

    public function add2Q(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                '2q_1' => 'required',
                '2q_2' => 'required',
            ],
            [
                '2q_1.required' => 'กรุณาระบุข้อ 1',
                '2q_2.required' => 'กรุณาระบุข้อ 2',
            ]
        );
        
        $q2 = $request->get('2q_1').",".$request->get('2q_2');

        DB::table('c_maxtrix_depress')->insert(
            [
                "dep_patient_id" => $id,
                "dep_2q" => $q2,
            ]
        );
        $patient = DB::table('patient')->where('patient_id', $id)->first();
        return back()->with('success','บันทึกข้อมูลประเมินซึมเศร้า 2Q : HN: '.$patient->patient_hn." ".$patient->patient_name);
    }

    public function Q9($id)
    {
        $patient = DB::table('patient')
            ->leftJoin('c_maxtrix_depress','c_maxtrix_depress.dep_patient_id','patient.patient_id')
            ->where('patient.patient_id', $id)
            ->first();
        return view('narcotic.methadone.9Q',['patient'=>$patient]);
    }

    public function Q8($id)
    {
        $patient = DB::table('patient')
            ->leftJoin('c_maxtrix_depress','c_maxtrix_depress.dep_patient_id','patient.patient_id')
            ->where('patient.patient_id', $id)
            ->first();
        return view('narcotic.methadone.8Q',['patient'=>$patient]);
    }

    public function add9Q(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                '9q_1' => 'required',
                '9q_2' => 'required',
                '9q_3' => 'required',
                '9q_4' => 'required',
                '9q_5' => 'required',
                '9q_6' => 'required',
                '9q_7' => 'required',
                '9q_8' => 'required',
                '9q_9' => 'required',
            ],
            [
                '9q_1.required' => 'กรุณาระบุข้อ 1',
                '9q_2.required' => 'กรุณาระบุข้อ 2',
                '9q_3.required' => 'กรุณาระบุข้อ 3',
                '9q_4.required' => 'กรุณาระบุข้อ 4',
                '9q_5.required' => 'กรุณาระบุข้อ 5',
                '9q_6.required' => 'กรุณาระบุข้อ 6',
                '9q_7.required' => 'กรุณาระบุข้อ 7',
                '9q_8.required' => 'กรุณาระบุข้อ 8',
                '9q_9.required' => 'กรุณาระบุข้อ 9',
            ]
        );
        
        $q9 = $request->get('9q_1').",".$request->get('9q_2').",".$request->get('9q_3').",".$request->get('9q_4').","
        .$request->get('9q_5').",".$request->get('9q_6').",".$request->get('9q_7').",".$request->get('9q_8').",".$request->get('9q_9');

        DB::table('c_maxtrix_depress')->where('dep_patient_id',$id)->update(
            [
                "dep_9q" => $q9,
            ]
        );
        $patient = DB::table('patient')->where('patient_id', $id)->first();
        return redirect()->route('matrix.depress', ['id' => $id])->with('success','บันทึกข้อมูลประเมินซึมเศร้า 9Q : HN: '.$patient->patient_hn." ".$patient->patient_name);
    }

    public function add8Q(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                '8q_1' => 'required',
                '8q_2' => 'required',
                '8q_3' => 'required',
                '8q_4' => 'required',
                '8q_5' => 'required',
                '8q_6' => 'required',
                '8q_7' => 'required',
                '8q_8' => 'required',
            ],
            [
                '8q_1.required' => 'กรุณาระบุข้อ 1',
                '8q_2.required' => 'กรุณาระบุข้อ 2',
                '8q_3.required' => 'กรุณาระบุข้อ 3',
                '8q_4.required' => 'กรุณาระบุข้อ 4',
                '8q_5.required' => 'กรุณาระบุข้อ 5',
                '8q_6.required' => 'กรุณาระบุข้อ 6',
                '8q_7.required' => 'กรุณาระบุข้อ 7',
                '8q_8.required' => 'กรุณาระบุข้อ 8',
            ]
        );
        
        $q8 = $request->get('8q_1').",".$request->get('8q_2').",".$request->get('8q_3').",".$request->get('8q_31').",".$request->get('8q_4').","
        .$request->get('8q_5').",".$request->get('8q_6').",".$request->get('8q_7').",".$request->get('8q_8');

        DB::table('c_maxtrix_depress')->where('dep_patient_id',$id)->update(
            [
                "dep_8q" => $q8,
            ]
        );
        $patient = DB::table('patient')->where('patient_id', $id)->first();
        return redirect()->route('matrix.depress', ['id' => $id])->with('success','บันทึกข้อมูลประเมินซึมเศร้า 8Q : HN: '.$patient->patient_hn." ".$patient->patient_name);
    }

    public function therapy($id)
    {
        $patient = DB::table('patient')->where('patient_id', $id)->first();
        return view('narcotic.methadone.therapy',['patient'=>$patient]);
    }

    public function addData(Request $request, $id)
    {
        if($request->get('labRes')){
            $arr_select = array();
            foreach($request->get('labRes') as $labRes){
                $arr_select[] = $labRes;
            }
            $labRess = implode(" <br> ", $arr_select);
        }else{ $labRess = ""; }

        $vital = "ส่วนสูง : ".$request->get('height')." <br> น้ำหนัก : ".$request->get('weight')." <br> BP : ".$request->get('bp')." <br> TEMP : ".
        $request->get('temp')." <br> HR : ".$request->get('hr')." <br> RR : ".$request->get('rr');
        $count = DB::table('c_matrix_therapy')->where('tp_patient_id',$id)->count();
        $time = $count + 1;
        DB::table('c_matrix_therapy')->insert(
            [
                'tp_patient_id' => $id,
                'tp_time' => $time,
                'tp_visit_id' => $request->get('pid'),
                'tp_vital_sign' => $vital,
                'tp_dx' => $request->get('dx'),
                'tp_ccpi' => $request->get('ccpi'),
                'tp_appointment' => $request->get('appoint'),
                'tp_viewer' => $request->get('viewer'),
                'tp_lab' => $labRess,
            ]
        );
        return back()->with('success','บันทึกข้อมูลการบำบัด ครั้งที่ '.$time.' สำเร็จ');
        // return dd($request->all());  
    }
}
