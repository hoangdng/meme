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
}
