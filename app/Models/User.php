<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\Account', 'username', 'username');
    }
}
