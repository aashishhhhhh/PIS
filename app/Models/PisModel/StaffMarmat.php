<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffMarmat extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'staff_marmat';

    protected $fillable = [
        'saman_bibaran',
        'saman_pahichan_no',
        'anumati_marmat_lagat',
        'reason',
        'applicant_name',
        'marmat_form_no',
        'remarks',
        'staff_id'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function marmatDetails()
    {
        return $this->hasMany(StaffMarmatDetails::class, 'marmat_form_no', 'marmat_form_no');
    }
}
