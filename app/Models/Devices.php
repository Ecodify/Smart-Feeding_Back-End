<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Devices extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'devices';
    protected $fillable = [
        'year',
        'month',
        'day',
        'hour',
        'data',
    ];

    protected $hidden = [];
}
