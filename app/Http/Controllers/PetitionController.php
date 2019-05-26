<?php

namespace App\Http\Controllers;

use App\Petitions;
use Illuminate\Http\Request;
use Auth;
class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petitions = Petitions::orderBy('id', 'asc')->paginate(10);
        return view('manage.petitions.index',  array('user' => Auth::user()))->withPetitions($petitions);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Petitions  $petitions
     * @return \Illuminate\Http\Response
     */
    public function show(Petitions $petitions)
    {
        return view('manage.petitions.show',  array('user' => Auth::user()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Petitions  $petitions
     * @return \Illuminate\Http\Response
     */
    public function edit(Petitions $petitions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Petitions  $petitions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petitions $petitions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Petitions  $petitions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petitions $petitions)
    {
        //
    }
}
