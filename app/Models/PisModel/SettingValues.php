<?php

namespace App\Models\PisModel;

use App\Models\SharedModel\SettingValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingValues extends Model
{

    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'settings_values';

    protected $fillable = [
        'name',
        'specification',
        'setting_id',
        'unit',
        'is_kharcha',
        'staff_id',
        'leave_type',
        'previous_leave_left'
    ];

    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function leaves()
    {
        return $this->belongsTo(settingLeave::class, 'leave_type', 'id');
    }
}
