<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class fahwanmai extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $all = DB::table('patient')->count();
        $finish = DB::table('patient')->where('patient_status',2)->count();
        $progress = DB::table('patient')->where('patient_status',1)->count();
        $lost = DB::table('patient')->where('patient_status',4)->count();
        $count = DB::select(DB::raw("SELECT
                (SELECT COUNT(patient_hn) FROM patient_program WHERE program_id = '1') AS mtx,
                (SELECT COUNT(patient_hn) FROM patient_program WHERE program_id = '2') AS mtd" ));
        $district = DB::select(DB::raw("SELECT 
                patient.patient_htambon AS tambon,
                district.dis_name AS tname,
                COUNT(DISTINCT patient.patient_id) AS total
                FROM patient
                LEFT JOIN district ON district.dis_value = patient.patient_htambon
                GROUP BY district.dis_name
                ORDER BY total DESC"));

        $mooname = DB::select(DB::raw("SELECT 
                patient.patient_hmooname AS mooname,
                COUNT(DISTINCT patient.patient_id) AS total
                FROM patient
                GROUP BY patient.patient_hmooname
                ORDER BY total DESC"));

        return view('clinic.fahwanmai.index',['all'=> $all,'finish'=> $finish,'progress'=> $progress,'lost'=> $lost,
        'count'=> $count,'district'=> $district,'mooname'=> $mooname]);
    }

    public function list()
    {
        $patient = DB::table('patient')
                ->join('patient_program','patient_program.patient_hn','patient.patient_hn')
                ->join('program','program.program_id','patient_program.program_id')
                // ->join('p_prefix','p_prefix.prefix_value','patient.patient_prefix')
                ->join('patient_status','patient_status.status_id','patient.patient_status')
                ->get();
        $program = DB::table('program')->get();

        return view('clinic.fahwanmai.list',['patient'=>$patient,'program'=>$program]);
    }

    public function register()
    {
        $religion = DB::table('religion')->get();
        $marriage = DB::table('marriage')->get();
        $education = DB::table('education')->get();
        $district = DB::table('district')->get();
        $province = DB::table('province')->get();
        $aumphur = DB::table('aumphur')->get();
        $sex = DB::table('p_sex')->get();
        $job = DB::table('job')->get();
        $program = DB::table('program')->get();

        return view('clinic.fahwanmai.register',['religion'=>$religion,'marriage'=>$marriage,'education'=>$education,
        'job'=>$job,'district'=>$district,'aumphur'=>$aumphur,'province'=>$province,'sex'=>$sex,'program'=>$program]);
    }

    public function newPatient(Request $request)
    {
        $check = DB::table('patient_program')
                ->where('patient_hn',$request->get('patient_hn'))
                ->where('pp_status','=',NULL)
                ->first();
        if(!isset($check)){
            $validatedData = $request->validate(
                [
                    'patient_hn' => 'required',
                    'patient_pid' => 'required',
                    'patient_name' => 'required',
                    'patient_gender' => 'required',
                    'patient_dob' => 'required',
                    'patient_religion' => 'required',
                    'patient_marriage' => 'required',
                    'patient_education' => 'required',
                    'patient_job' => 'required',
                    'patient_benefit' => 'required',
                    'patient_tel' => 'required',
                    'patient_hno' => 'required',
                    'patient_hroad' => 'required',
                    'patient_hmoo' => 'required',
                    'patient_hmooname' => 'required',
                    'patient_htambon' => 'required',
                    'patient_aumphur' => 'required',
                    'patient_province' => 'required',
                    'patient_live' => 'required',
                    'patient_family' => 'required',
                    'patient_program' => 'required'
                ],
                [
                    'patient_hn.required' => 'กรุณาระบุ HN',
                    'patient_pid.required' => 'กรุณาระบุหมายเลข 13 หลัก',
                    'patient_name.required' => 'กรุณาระบุชื่อผู้เข้ารับการบำบัด',
                    'patient_gender.required' => 'กรุณาระบุเพศ',
                    'patient_dob.required' => 'กรุณาระบุวันเกิด',
                    'patient_religion.required' => 'กรุณาระบุศาสนา',
                    'patient_marriage.required' => 'กรุณาระบุสถานะความสัมพันธ์',
                    'patient_education.required' => 'กรุณาระบุระดับการศึกษา',
                    'patient_job.required' => 'กรุณาระบุอาชีพ',
                    'patient_benefit.required' => 'กรุณาระบุรายได้/เดือน',
                    'patient_tel.required' => 'กรุณาระบุเบอร์โทรศัพท์',
                    'patient_hno.required' => 'กรุณาระบุบ้านเลขที่',
                    'patient_hroad.required' => 'กรุณาระบุถนน',
                    'patient_hmoo.required' => 'กรุณาระบุหมู่',
                    'patient_hmooname.required' => 'กรุณาระบุชื่อหมู่บ้าน',
                    'patient_htambon.required' => 'กรุณาระบุตำบล',
                    'patient_aumphur.required' => 'กรุณาระบุอำเภอ',
                    'patient_province.required' => 'กรุณาระบุจังหวัด',
                    'patient_live.required' => 'กรุณาระบุผู้ที่อาศัยอยู่ด้วยใน 30 วันที่ผ่านมา',
                    'patient_family.required' => 'กรุณาระบุความสัมพันธ์ระหว่างบิดา-มารดา',
                    'patient_program.required' => 'กรุณาระบุโปรแกรมที่เข้ารับการบำบัด'
                ],
            );
    
            if($request->get('patient_live')){
                $arr_select = array();
                foreach($request->get('patient_live') as $patient_live){
                    $arr_select[] = $patient_live;
                }
                $patient_lives = implode(",", $arr_select);
            }else{
                $patient_lives = "";
            }
    
            DB::table('patient')->insert(
                [
                    "patient_hn" => $request->get('patient_hn'),
                    "patient_prefix" => $request->get('patient_prefix'),
                    "patient_gender" => $request->get('patient_gender'),
                    "patient_name" => $request->get('patient_name'),
                    "patient_dob" => $request->get('patient_dob'),
                    "patient_pid" => $request->get('patient_pid'),
                    "patient_religion" => $request->get('patient_religion'),
                    "patient_marriage" => $request->get('patient_marriage'),
                    "patient_education" => $request->get('patient_education'),
                    "patient_job" => $request->get('patient_job'),
                    "patient_benefit" => $request->get('patient_benefit'),
                    "patient_tel" => $request->get('patient_tel'),
                    "patient_hno" => $request->get('patient_hno'),
                    "patient_hroad" => $request->get('patient_hroad'),
                    "patient_hmoo" => $request->get('patient_hmoo'),
                    "patient_hmooname" => $request->get('patient_hmooname'),
                    "patient_htambon" => $request->get('patient_htambon'),
                    "patient_aumphur" => $request->get('patient_aumphur').'00',
                    "patient_province" => $request->get('patient_province').'0000',
                    "patient_live" => $patient_lives,
                    "patient_family" => $request->get('patient_family'),
                ]
            );
    
            DB::table('patient_program')->insert(
                [
                    "program_id" => $request->get('patient_program'),
                    "patient_hn" => $request->get('patient_hn'),
                ]
            );
            return redirect()->route('fah.list')->with('success','ลงทะเบียนผู้รับการบำบัดใหม่สำเร็จ : HN: '.$request->get('patient_hn')." ".$request->get('patient_name'));
        }else{
            return redirect()->route('fah.register')->with('error','HN: '.$check->patient_hn.' มีการลงทะเบียนแล้ว');
        }
    }

    public function showPatient($id)
    {
        $patient = DB::table('patient')
                ->join('patient_program','patient_program.patient_hn','patient.patient_hn')
                ->join('program','program.program_id','patient_program.program_id')
                ->join('patient_status','patient_status.status_id','patient.patient_status')
                ->where('patient.patient_id', $id)
                ->first();
        $religion = DB::table('religion')->get();
        $marriage = DB::table('marriage')->get();
        $education = DB::table('education')->get();
        $district = DB::table('district')->get();
        $aumphur = DB::table('aumphur')->get();
        $province = DB::table('province')->get();
        $sex = DB::table('p_sex')->get();
        $job = DB::table('job')->get();
        $program = DB::table('program')->get();

        return view('clinic.fahwanmai.show',['patient'=>$patient,'religion'=>$religion,'marriage'=>$marriage,'education'=>$education,
        'job'=>$job,'district'=>$district,'aumphur'=>$aumphur,'province'=>$province,'sex'=>$sex,'program'=>$program]);
    }

    public function updatePatient(Request $request, $id)
    {
        DB::table('patient')->where('patient_id', $id)->update(
            [
                "patient_gender" => $request->get('patient_gender'),
                "patient_name" => $request->get('patient_name'),
                "patient_dob" => $request->get('patient_dob'),
                "patient_religion" => $request->get('patient_religion'),
                "patient_marriage" => $request->get('patient_marriage'),
                "patient_education" => $request->get('patient_education'),
                "patient_job" => $request->get('patient_job'),
                "patient_benefit" => $request->get('patient_benefit'),
                "patient_tel" => $request->get('patient_tel'),
                "patient_hno" => $request->get('patient_hno'),
                "patient_hroad" => $request->get('patient_hroad'),
                "patient_hmoo" => $request->get('patient_hmoo'),
                "patient_hmooname" => $request->get('patient_hmooname'),
                "patient_htambon" => $request->get('patient_htambon'),
                "patient_aumphur" => $request->get('patient_aumphur'),
                "patient_province" => $request->get('patient_province'),
            ]
        );
        return back()->with('success','แก้ไขทะเบียนผู้รับการบำบัดสำเร็จ : HN: '.$request->get('patient_hn')." ".$request->get('patient_name'));
    }

    public function consentPrint($id)
    {
        $patient = DB::table('patient')->where('patient_id', $id)->first();
        return view('clinic.consent',['patient'=>$patient]);
    }

    public function dischargePatient(Request $request, $id)
    {
        $note = $request->get('formData');
        $date = date("Y-m-d");
        DB::table('patient')->where('patient_id', $id)->update(
            [
                'patient_status' => $note,
                'patient_dc_date' => $date,
            ]
        );
    }
}
