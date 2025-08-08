<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProkerNotification extends Model
{
    protected $table = 'proker_notifications';
    protected $fillable = [
        'model',
        'proker_id',
        'message'
    ];
}
