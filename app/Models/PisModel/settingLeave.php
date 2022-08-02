<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settingLeave extends Model
{
    use HasFactory;
    protected $connection = 'mysql_shared';

    protected $fillable = [
        'fiscal_year',
        'leave_type',
        'applicable_for',
        'total_leave'
    ];
}
