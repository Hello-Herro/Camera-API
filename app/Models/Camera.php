<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'sensor_type',
        'resolution',
        'price'
    ];
}
