<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Charts;
use App\User;
use App\Bill;
use App\Petitions;
use DB;

class ManageController extends Controller
{
    public function index(){

        return redirect()->route('manage.dashboard');
    }
    public function dashboard(){
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $bills = Bill::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $petitions = Petitions::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();

        $userschart = Charts::database($users, 'bar', 'highcharts')
			      ->title("Monthly new Register Users")
			      ->elementLabel("Total Users")
			      ->dimensions(600, 500)
			      ->responsive(true)
                  ->groupByMonth(date('Y'), true);
        
        
        $billschart = Charts::database($bills, 'pie', 'highcharts')
        ->title("Number of Bills Per Month")
        ->elementLabel("Bills")
        ->dimensions(600, 500)
        ->responsive(true)
        ->groupByMonth(date('Y'), true);

        $petitionschart = Charts::database($petitions, 'area', 'highcharts')
        ->title("Number of Petitions Per Month")
        ->elementLabel("Petitions")
        ->dimensions(600, 500)
        ->responsive(true)
        ->groupByMonth(date('Y'), true);


        return view('manage.dashboard', compact('userschart', 'billschart', 'petitionschart'),  array('user' => Auth::user()));
    }
}
