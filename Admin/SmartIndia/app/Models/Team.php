<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Team extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='teams';
    protected $fillable = [
        'name', 'team_name','user_id','topic_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('team_token','created_at', 'updated_at','user_id');
    
}
