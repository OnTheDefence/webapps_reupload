<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use \Conner\Likeable\Likeable;

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }
}
