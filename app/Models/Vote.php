<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username',
        'post_id',
        'type',
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
