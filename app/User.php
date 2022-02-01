<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject{
    use Notifiable;
    // protected $fillable = [
    //     'email',
    //     'password',
    //     'first_name',
    //     'last_name',
    //   //  'per'
    // ];
    function roles(){
        return $this->belongsToMany('App\Role','role_users');
    }
    //JWT kholbolt
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    //
    public function getJWTCustomClaims()
    {
        return [];
    }
}
