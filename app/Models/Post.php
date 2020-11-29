<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'posted_date',
        'username',
        'status',
        'vote_up',
        'vote_down',
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'post_category', 'post_id', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id');
    }

    public function reports()
    {
        return $this->hasMany('App\Models\Report', 'post_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany('App\Models\Vote', 'post_id', 'id');
    }
}
