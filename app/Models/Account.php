<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Account extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    //declare columns for mass assignment
    protected $fillable = [
        'email', 'username', 'password',
    ];


    //declare relationships
    public function user()
    {
        return $this->hasOne('App\Models\User', 'username', 'username');
    }

    //check if this account is belong to an admin or not
    public function isAdmin()
    {
        $role = User::where('username', $this->username)->first()->role;
        
        if ($role == "ROLE_ADMIN")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
