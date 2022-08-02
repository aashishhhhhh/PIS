<?php

namespace App\Models\PisModel;

use App\Models\SharedModel\SettingValue;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffService extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_services';

    protected $fillable = [
        'user_id',
        'service',
        'office_group',
        'office_subgroup',
        'position',
        'level',
        'office_name_address',
        'office_name_address_english',
        'new_appoint',
        'decision_date',
        'restoration_date',
        'is_active'
    ];

    public function positions()
    {
        return $this->belongsTo(SettingValue::class, 'position', 'id');
    }

    public function levels()
    {
        return $this->belongsTo(SettingValue::class, 'level', 'id');
    }

    public function bhattas()
    {
        return $this->belongsTo(SettingsBhatta::class, 'position', 'position');
    }

    public function officeGroups()
    {
        return $this->belongsTo(SettingValue::class, 'office_group', 'id');
    }

    public function services()
    {
        return $this->belongsTo(SettingValue::class, 'service', 'id');
    }
}
