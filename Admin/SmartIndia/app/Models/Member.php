<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Member extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='members';
    protected $fillable = [
        'team_id', 'name','email','phone','dob', 'sex','department','semester','reg_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('created_at', 'updated_at','status');
    
}
