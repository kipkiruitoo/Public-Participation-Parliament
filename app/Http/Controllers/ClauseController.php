<?php

namespace App\Http\Controllers;

use App\Clause;
use Illuminate\Http\Request;

class ClauseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
        $clause = new Clause();
        $clause->name = $request->name;
        $clause->description = $request->description;
        $clause->bill = $request->bill;

        if ($clause->save()) {
           return redirect()->route('bill.edit', $clause->bill);
        }else {
           echo 'an error occured tryiing to save';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clause  $clause
     * @return \Illuminate\Http\Response
     */
    public function show(Clause $clause)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clause  $clause
     * @return \Illuminate\Http\Response
     */
    public function edit(Clause $clause)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clause  $clause
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clause $clause)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clause  $clause
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clause $clause)
    {
      
        $id = $clause->id;

        echo $id;

        $del = Clause::where('id', $id)->first();

        print_r($del);

     
    }
}
