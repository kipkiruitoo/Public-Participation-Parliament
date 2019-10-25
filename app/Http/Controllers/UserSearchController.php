<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\User;

class UserSearchController extends Controller
{
  public function index(Request $request)
  {
    $results = (new Search())
    ->registerModel(User::class, ['name','email', 'idnumber'])
    ->search($request->input('query'));
    
    return response()->json($results);
  }
}
