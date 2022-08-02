<?php

namespace App\Models\PisModel;

use App\Models\SharedModel\SettingValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsBhatta extends Model
{

    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'settings_bhatta';
    protected $fillable = [
        'position',
        'bhatta'
    ];

    public function positions()
    {
        return $this->belongsTo(SettingValue::class, 'position', 'id');
    }
}
