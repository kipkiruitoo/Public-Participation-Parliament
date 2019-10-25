<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use DevDojo\Chatter\Models\Post;

class PostSearchController extends Controller
{
    //

    public function index(Request $request)
  {
    $results = (new Search())
    ->registerModel(Post::class, ['body'])
    ->search($request->input('query'));
    
    return response()->json($results);
  }
}
