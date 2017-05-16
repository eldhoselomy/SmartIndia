<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class DeviceNotification extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='device_notifications';
    protected $fillable = [
        'user_id', 'firebase_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('created_at', 'updated_at','status');
    
}
