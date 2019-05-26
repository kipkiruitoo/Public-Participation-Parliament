<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
    public function learn(){
        return view('welcome',  array('user' => Auth::user()));
    }
    public function index()
    {
        return view('home',  array('user' => Auth::user()));
    }
    public function participate(){

        return view('participate',  array('user' => Auth::user()));
    }
    public function discuss(){

        return view('discuss',  array('user' => Auth::user()));
    }
}
