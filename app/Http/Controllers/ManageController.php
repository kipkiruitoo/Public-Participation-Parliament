<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ManageController extends Controller
{
    public function index(){
        return redirect()->route('manage.dashboard');
    }
    public function dashboard(){
        return view('manage.dashboard',  array('user' => Auth::user()));
    }
}
