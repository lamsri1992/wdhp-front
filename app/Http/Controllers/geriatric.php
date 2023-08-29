<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class geriatric extends Controller
{
    public function index()
    {
        return view('clinic.geriatric.index');
    }
}
