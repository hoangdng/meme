<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'image_location',
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
}
