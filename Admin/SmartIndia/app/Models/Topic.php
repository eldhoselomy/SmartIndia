<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Topic extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='topics';
    protected $fillable = [
        'name', 'user_id', 'subject','description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('created_at', 'updated_at','status','user_id');
}
