<?php

namespace App\Models\PisModel;

use App\Models\SharedModel\SettingValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffLanguage extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_languages';

    protected $fillable = [
        'user_id',
        'language',
        'type',
        'writing',
        'reading',
        'speaking'
    ];

    public function languages()
    {
        return $this->belongsTo(SettingValue::class, 'language', 'id');
    }
}
