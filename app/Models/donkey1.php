<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donkey1 extends Model
{
    use HasFactory;
    protected $fillable = [
        'leave_request_id',
        'file_name',
        'file_path'
    ];

    protected $table = 'leave_documents';
    protected $primaryKey = 'id';

}
