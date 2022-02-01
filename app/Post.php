<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use Notifiable;
    
    protected $fillable = ['id','title','content','more_text','title_img','post_img','post_count'];

}
