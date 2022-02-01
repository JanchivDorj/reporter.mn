<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Role extends Model
{
    protected $table ='roles';
    protected $fillable = ['id','slug','name'];
    
}
