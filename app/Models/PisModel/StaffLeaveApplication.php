<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffLeaveApplication extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'staff_leave_application';

    protected $fillable = [
        'fiscal_year',
        'staff_name',
        'staff_s_no',
        'staff_position',
        'office_name',
        'leave_type',
        'from_date',
        'to_date',
        'leave_reason',
        'official_signature',
        'is_approved',
        'cao_approved'
    ];

    public function settingLeaves()
    {
        return $this->belongsTo(settingLeave::class, 'leave_type');
    }
}
