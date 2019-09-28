<?php

namespace App\Http\Controllers;

use Charts;
use App\User;
use App\Bill;
use Google\Cloud\Core\ServiceBuilder;
use DevDojo\Chatter\Models\Models;

use Illuminate\Http\Request;
use Storage;
use Response;
use Auth;
 
class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::orderBy('id', 'desc')->paginate(10);

        return view('manage.bills.index',  array('user' => Auth::user()))->withBills($bills);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('manage.bills.create',  array('user' => Auth::user()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'number' => ['required', 'numeric', ],
            'description' => ['required', 'string']
        ]);
        $file = $request->file('bill');
        
        $bill = new Bill();
        $bill->name = $request->title;
        $bill->number = $request->number;
        $bill->description = $request->description;
        $bill->slug = str_slug($request->title);
        $bill->author_id = $request->user()->id;
        if ($request->hasFile('bill')) {

            $file = $request->file('bill');

            $filename = $bill->slug;

            $extension = $file->getClientOriginalExtension();
        // FIXME: PLEASE
        $file->storeAs('public/bills',$filename . '.' .  $extension);
        
        $bill->file = $filename  . '.' . $extension;

        
        
    
        }


        // $bill->save();
        if ($bill->save()) {
            return redirect()->route('bill.show', $bill->id);
        }
        else {
            $request->session()->flash('danger', 'Sorry a problem occured while creating user. try again later or contact the developer');

            return redirect()->route('bill.create',  array('user' => Auth::user()));
        }
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {   $id = $bill->id;
        $discussion = Models::discussion()->where('chatter_category_id', $id)->first();

        
        // Google cloud instantiations
        $cloud = new ServiceBuilder([
            'keyFilePath' => base_path('isproject.json'),
            'projectId' => 'isproject-252907'
        ]);

        $language = $cloud->language();

        $sscores = array();

        $magnitudes = array();
        $comments = Models::post()->where('chatter_discussion_id', $discussion->id)->get();

//         $comments = array_map(function($comments){
// //     return (array) $object;
// // }, $comments);

        $sanitized = [];

        foreach ($comments as $comment) {

            array_push($sanitized, $comment);
            
        //    echo $comment->body;
            $annotation = $language->analyzeSentiment(strip_tags($comment->body));
            $sentiment = $annotation->sentiment();

            array_push($sscores,$sentiment['score']);

            array_push($magnitudes, $sentiment['magnitude']);

        }

        // average score of the sentiments
        array_shift($sscores);
        array_shift($magnitudes);
        
        $s = array_filter($sscores);
        $avscore = array_sum($s)/count($s);

        $scomment = "Loading Comment";

        array_shift($sanitized);
        

        if ($avscore >= 0.5  ) {
            $scomment = "Mostly Positive";
        }elseif (0.1<= $avscore && $avscore < 0.5) {
            $scomment = "Somehow Positive";
        }
        else if ($avscore < 0 ) {
            $scomment = "Negative";
        }elseif (-0.1 <= $avscore && $avscore <= 0.1) {
            $scomment = "Mostly Neutral";
        }else{
            $scomment = "Mixed";
        }

        // average score of the magnitude

        $m = array_filter($magnitudes);
        $avmagnitudes = array_sum($m)/ count($m);

        $mcomment ="Emotion of the Text";

        if ($avmagnitudes == 0.0  ) {
            $mcomment = "Neutral";
        }else if ($avmagnitudes > 4 ) {
            $mcomment = "Strong Emotion";
        }elseif ($avmagnitudes < 2.5) {
            $mcomment = "Weak Emotion";
        }

        $sentchart = Charts::multi('line', 'highcharts')
        ->title('Sentiment Scores Against Magnitude Scores')
    ->labels(["Scores",])
    ->elementLabel('points')
    ->dataset('Sentiment Scores', $s)
    ->dataset('Magnitude Scores', $m)
    ->dimensions(600,500)
   
    ->responsive(true);
        
        $bill = Bill::findOrFail($id)->first();
        
        
        return view('manage.bills.show', compact('sanitized', 'mcomment','scomment', 'avscore', 'avmagnitudes', 'sentchart') , array('user' => Auth::user()))->withBill($bill);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        $bill = Bill::where('id', $bill->id)->first();

        return view('manage.bills.edit',  array('user' => Auth::user()))->withBill($bill);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'number' => ['required', 'numeric', ],
            'description' => ['required', 'string']
        ]);
        $id = $bill->id;
        $bill = Bill::findOrFail($id);
        $bill->name = $request->title;
        $bill->number = $request->number;
        $bill->description = $request->description;
        $bill->slug = str_slug($request->title);
        $bill->author_id = $request->user()->id;
        if ($request->hasFile('bill')) {

            $file = $request->file('bill');

            $filename = $bill->slug;

            $extension = $file->getClientOriginalExtension();
        // FIXME: PLEASE
        $file->storeAs('public/bills',$filename . '.' .  $extension);
        
        $bill->file = $filename  . '.' . $extension;

        
        
    
        }
        if ($bill->save()) {
            return redirect()->route('bill.show', $bill->id);
        }
        else {
            $request->session()->flash('danger', 'Sorry a problem occured while creating user. try again later or contact the developer');

            return redirect()->route('bill.edit',  array('user' => Auth::user()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
//* TODO: Fix the pdf upload and the thing FIXME:

    public function viewpdf(Bill $bill){

        $path = $bill->file;
        $storagepath = storage_path();
        
        return Response::make(file_get_contents($storagepath ."\app\public\bills\\". str_replace('/', '\\', $path)), 200, [

            'Content-Type'
        => 'application/pdf',
        
           
        'Content-Disposition' => 'inline; filename="'.$bill->slug.'"'
        
        ]);

        // if ( Storage::get($storagepath ."\app\public\bills\\". str_replace('/', '\\', $path)) ) { 

           
         
        //     } else { 
        //         echo $path;
            
        //     }

// FIXME: PLEASE
    
    }
}
