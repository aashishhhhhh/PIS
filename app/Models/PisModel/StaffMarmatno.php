<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffMarmatno extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_marmat_no';
    protected $fillable = [
        'marmat_form_no',
        'staff_id',
        'is_verified',
        'is_approved'
    ];

    public function marmats()
    {
        return $this->hasMany(StaffMarmat::class, 'marmat_form_no', 'marmat_form_no');
    }

    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function marmatStoreKeeper()
    {
        return $this->hasOne(StaffMarmatStoreKeeper::class, 'marmat_form_no', 'marmat_form_no');
    }
}
