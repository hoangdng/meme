<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username', 'status', 'role'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\Account', 'username', 'username');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'username', 'username');
    }

    public function reports()
    {
        return $this->hasMany('App\Models\Report', 'username', 'username');
    }

    public function votes()
    {
        return $this->hasMany('App\Models\Vote', 'username', 'username');
    }
}
