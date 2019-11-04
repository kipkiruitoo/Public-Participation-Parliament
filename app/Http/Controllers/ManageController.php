<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Charts;
use App\User;
use App\Bill;
use Google\Cloud\Core\ServiceBuilder;
use DevDojo\Chatter\Models\Models;
// use App\Petitions;
use DB;
class ManageController extends Controller
{
    public function index(){
        return redirect()->route('manage.dashboard');
    }
    public function dashboard(){

        $data;
        $billsdata = Bill::all();
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $bills = Bill::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();

        $labels = Bill::all()->pluck('name');
        // print_r($labels->toArray());
        $ncomments = Models::post()->count();
        $comms = Models::post()->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
        $nusers = User::count();
        // $petitions = Petitions::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $userschart = Charts::database($users, 'bar', 'fusioncharts')
			      ->title("Monthly new Registered Users")
			      ->elementLabel("Total Users")
			      ->dimensions(600, 500)
			      
                  ->groupByMonth(date('Y'), true);
        
        
        $billschart = Charts::database($bills, 'bar', 'fusioncharts')
        ->title("Number of Bills Per Month")
        ->elementLabel("Bills")
        ->dimensions(600, 500)
       
        ->groupByMonth(date('Y'), true);

        

        $commentchart = Charts::database($comms, 'bar', 'fusioncharts')->title("No of contributions each month")
			      ->elementLabel("Total Number of Contributions")
			      ->dimensions(600, 500)
			     
                  ->groupByMonth(date('Y'), true);
                  
        $newchart = Charts::database(Models::post()->all(), 'pie', 'fusioncharts')
                ->title('Contributions Per Bill')
                ->elementLabel("Contributions per Bill")
                  ->dimensions(600, 500)
                ->labels($labels->toArray())
             
                  ->groupBy('chatter_discussion_id',  Models::discussion()->bill, $labels->toArray());
        
        
        // print_r($labels->toArray());
        return view('manage.dashboard', compact('userschart', 'billschart', 'ncomments', 'nusers', 'commentchart', 'newchart'),  array('user' => Auth::user()));
    }
}