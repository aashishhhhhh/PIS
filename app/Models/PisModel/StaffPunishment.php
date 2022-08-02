<?php

namespace App\Models\PisModel;

use App\Models\SharedModel\SettingValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffPunishment extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_punishments';

    protected $fillable = [
        'user_id',
        'punishment',
        'ordered_date',
        'stopped',
        'stopped_date',
        'remarks'
    ];

    public function punishments()
    {
        return $this->belongsTo(SettingValue::class, 'punishment', 'id');
    }
}
