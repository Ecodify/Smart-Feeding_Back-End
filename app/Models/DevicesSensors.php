<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DevicesSensors extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'devices_sensors';
    protected $fillable = [
        'year',
        'month',
        'day',
        'timestamp',
        'temperature',
        'humidity',
        'ammonia'
    ];

    protected $hidden = [];
}
