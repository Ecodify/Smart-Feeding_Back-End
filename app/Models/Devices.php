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
        'mq',
        'relay_a',
        'relay_b'
    ];

    protected $hidden = [
        'id',
        'updated_at',
        'created_at'
    ];

    protected $casts = [
        'dht' =>'boolean',
        'mq' =>'boolean',
        'relay_a' =>'boolean',
        'relay_b' =>'boolean'
        ];
}
