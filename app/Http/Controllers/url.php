<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class url extends Controller
{
    public function exjhcis()
    {
       return view('visit.exjhcis');
    }
}