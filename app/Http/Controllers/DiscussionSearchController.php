<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use DevDojo\Chatter\Models\Discussion;


class DiscussionSearchController extends Controller
{
    //

    public function index(Request $request)
  {
    $results = (new Search())
    ->registerModel(Discussion::class, ['title'])
    ->search($request->input('query'));
    
    return response()->json($results);
  }
}
