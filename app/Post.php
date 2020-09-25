<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'slug', 'body', 'category_id', 'thumbnail'];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
