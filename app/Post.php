<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Post extends Eloquent
{
    protected $collection = 'posts';
	
	protected $fillable = ['title', 'description'];
       // public function user()
        // {
            // return $this->belongsTo('App\User');
        // }
}
