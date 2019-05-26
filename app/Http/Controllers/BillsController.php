<?php

namespace App\Http\Controllers;

use App\Bill;
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
        $bill->title = $request->title;
        $bill->number = $request->number;
        $bill->description = $request->description;
        $bill->slug = str_slug($request->title);
        $bill->author_id = $request->user()->id;
        $path = $request->file('bill')->storeAs('bills',str_slug($request->title) );
        
        $bill->file = $path;

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
    {
        $id = $bill->id;
        $bill = Bill::findOrFail($id)->first();
        return view('manage.bills.show',  array('user' => Auth::user()))->withBill($bill);
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
        $bill->title = $request->title;
        $bill->number = $request->number;
        $bill->description = $request->description;
        $bill->slug = str_slug($request->title);
        $bill->author_id = $request->user()->id;
        if ($request->file('bill')) {
            $file = $request->file('bill');
            $path = $request->file('bill')->storeAs('bills',str_slug($request->title));
        
            $bill->file = $path;
    
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
        
        return Response::make(file_get_contents($storagepath ."\app\\". str_replace('/', '\\', $path)  . '.pdf'), 200, [

            'Content-Type'
        => 'application/pdf',
        
           
        'Content-Disposition' => 'inline; filename="'.$bill->slug.'"'
        
        ]);

        // if ( Storage::get($storagepath ."\app\\". str_replace('/', '\\', $path) . '.pdf') ) { 

           
         
            // } else { 
                // echo $path;
            
            // }

// FIXME: PLEASE
    
    }
}
