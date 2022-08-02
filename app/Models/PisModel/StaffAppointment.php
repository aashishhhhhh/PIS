<?php

namespace App\Models\PisModel;

use App\Models\SharedModel\SettingValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAppointment extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_appointments';

    protected $fillable = [
        'user_id',
        'office_name_address',
        'appoint_date',
        'decision_date',
        'attend_date',
        'service',
        'office_group',
        'office_subgroup',
        'level',
        'position',
        'technical'
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
}
