<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Media extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='media';
    protected $fillable = [
        'file_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('created_at', 'updated_at','status','team_id');
}
