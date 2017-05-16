<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Feedback extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='feedback';
    protected $fillable = [
        'user_id', 'team_id','user_type','title','comments'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('created_at', 'updated_at','status');
    
}
