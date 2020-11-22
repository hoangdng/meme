<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username',
        'post_id',
        'content',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'username', 'username');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id', 'id');
    }
}
