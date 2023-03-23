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

    public function report(Request $request)
    {
        $dstart = $request->dstart;
        $dended = $request->dended;
        return view('clinic.anc.report',['dstart'=>$dstart,'dended'=>$dended]);
    }
}