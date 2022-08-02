<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffMaagno extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'staff_maag_no';

    protected $fillable = [
        'maag_no',
        'is_approved',
        'is_verified',
        'staff_id'
    ];

    public function maags()
    {
        return $this->hasMany(StaffMaag::class, 'maag_no', 'maag_no');
    }

    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
}
