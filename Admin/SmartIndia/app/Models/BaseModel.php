<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseModel extends Authenticatable
{
    protected $connection = 'mysql';
}
