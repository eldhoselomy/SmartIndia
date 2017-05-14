<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Notification extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='notifications';
    protected $fillable = [
        'title', 'description','notification_type','notification_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('created_at', 'updated_at','status');
    
}
