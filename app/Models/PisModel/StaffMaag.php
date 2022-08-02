<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffMaag extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'staff_maag';
    protected $fillable = [
        'fiscal_year',
        'saman_name',
        'specification',
        'unit',
        'quantity',
        'remarks',
        'staff_id',
        'maag_no',
        'kharid_type',
        'is_verified'
    ];

    public function saman()
    {
        return $this->belongsTo(SettingValues::class, 'saman_name', 'id');
    }

    public function maag_details()
    {
        return $this->belongsTo(StaffMaagDetails::class, 'maag_no', 'maag_no');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
}
