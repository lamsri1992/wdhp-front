<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::select('SELECT hos.h_name,h_visit.pcucode,hos.h_his,COUNT(*) AS total,MAX(h_visit.v_created) AS last_update
                FROM h_visit
                LEFT JOIN hos ON hos.h_code = h_visit.pcucode
                GROUP BY pcucode
                ORDER BY total DESC');
        return view('index',['data'=>$data]);
    }
}
