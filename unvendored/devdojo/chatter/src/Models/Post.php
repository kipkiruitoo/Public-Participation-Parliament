<?php

namespace DevDojo\Chatter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

     public function getSearchResult(): SearchResult
     {
        $url = url('forums/discussion/' . $this->category->slug. '/' . $this->slug);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url
         );
     }
    
    protected $table = 'chatter_post';
    public $timestamps = true;
    protected $fillable = ['chatter_discussion_id', 'user_id', 'body', 'markdown'];
    protected $dates = ['deleted_at'];

    public function discussion()
    {
        return $this->belongsTo(Models::className(Discussion::class), 'chatter_discussion_id');
    }

    public function user()
    {
        return $this->belongsTo(config('chatter.user.namespace'));
    }
}
