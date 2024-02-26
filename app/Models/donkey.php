<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donkey extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'leave_type',
        'leave_days',
        'reason',
        'request_date',
        'approved_by',
        'status',
    ];

    protected $table = 'leave_requests';
    protected $primaryKey = 'id';

}
