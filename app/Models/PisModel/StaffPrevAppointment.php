<?php

namespace App\Models\PisModel;

use App\Models\SharedModel\SettingValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffPrevAppointment extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_prev_appointments';

    protected $fillable = [
        'user_id',
        'office_name_address',
        'service',
        'office_group',
        'office_subgroup',
        'level',
        'position',
        'technical',
        'leave_date',
        'leave_reason'
    ];
    public function services()
    {
        return $this->belongsTo(SettingValue::class, 'service', 'id');
    }

    public function levels()
    {
        return $this->belongsTo(SettingValue::class, 'level', 'id');
    }

    public function positions()
    {
        return $this->belongsTo(SettingValue::class, 'position', 'id');
    }

    public function officeGroups()
    {
        return $this->belongsTo(SettingValue::class, 'office_group', 'id');
    }

    public function officeSubGroups()
    {
        return $this->belongsTo(SettingValue::class, 'office_subgroup', 'id');
    }
}
