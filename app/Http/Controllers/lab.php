<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class lab extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function list()
    {
        
    }
}
