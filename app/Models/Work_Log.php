<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'log_id',
        'Day_work',
        'start_time',
        'end_time',
        'Users',
        'latitude',
        'longitude',
        'latitude1',
        'longitude1',
    ];
    protected $table = 'work__logs';
    protected $primaryKey = 'log_id';

}
