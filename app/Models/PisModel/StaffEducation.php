<?php

namespace App\Models\PisModel;

use App\Models\SharedModel\SettingValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffEducation extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_educations';

    protected $fillable = [
        'user_id',
        'qualification',
        'subject',
        'year',
        'position',
        'institute'
    ];

    public function qualifications()
    {
        return $this->belongsTo(SettingValue::class, 'qualification', 'id');
    }

    public function subjects()
    {
        return $this->belongsTo(SettingValue::class, 'subject', 'id');
    }

    public function positions()
    {
        return $this->belongsTo(SettingValue::class, 'position', 'id');
    }

    public function institutes()
    {
        return $this->belongsTo(SettingValue::class, 'institute', 'id');
    }
}
