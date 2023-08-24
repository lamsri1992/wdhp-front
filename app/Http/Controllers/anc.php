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
        return view('clinic.anc.show',['id'=>$id]);
    }

    public function report(Request $request)
    {
        $dstart = $request->dstart;
        $dended = $request->dended;
        return view('clinic.anc.report',['dstart'=>$dstart,'dended'=>$dended]);
    }
}