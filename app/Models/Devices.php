<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Devices extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'devices';
    protected $fillable = [
        'name',
        'category',
        'population',
        'status',
        'dht',
        'relay',
        'mq'
    ];

    protected $hidden = [];

    protected $casts = [
        'dht' =>'boolean',
        'relay' =>'boolean',
        'mq' =>'boolean'
        ];
}
