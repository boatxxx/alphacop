<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CssSetting extends Model
{
    protected $fillable = [
        'background_image',
        'background_color',
        'table_border_color',
        'font_size',
        // ฟิลด์อื่น ๆ ตามต้องการ
    ];
    protected $table = 'css_settings';

    protected $primaryKey = 'id';

}
