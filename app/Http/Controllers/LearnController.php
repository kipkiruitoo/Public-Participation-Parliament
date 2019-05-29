<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LearnController extends Controller
{
    
    public function learn(){
        return view('welcome',  array('user' => Auth::user()));
    }
}
