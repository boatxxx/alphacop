<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class money_Log extends Model
{
    use HasFactory;

    protected $table = 'salary_slips'; // ใช้ตาราง salary_slips ในฐานข้อมูล

    protected $fillable = [
        'company_name',
        'address',
        'country',
        'phone',
        'email',
        'issued_date',
        'employee_name',
        'employee_id',
        'branch',
        'position',
        'start_date',
        'end_date',
        'income_items',
        'deduction_items',
        'net_amount',
        'signature',
    ];
    protected $primaryKey = 'id';

}
