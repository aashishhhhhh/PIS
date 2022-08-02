<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffVisitAadesh extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_visit_aadesh';

    protected $fillable = [
        'date',
        's_no',
        'staff',
        'position',
        'office',
        'visit_place_name',
        'visit_aim',
        'from_date',
        'to_date',
        'visit_vehicle',
        'visit_details',
        'visit_staff',
        'visit_approver',
        'visit_expense',
        'visit_staff_date',
        'approved_date',
        'staff_id',
        'aadesh_no',
        'is_approved'
    ];

    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function approver()
    {
        return $this->belongsTo(Staff::class, 'visit_approver', 'id');
    }

    public function staffVisitAadeshDetail()
    {
        return $this->hasMany(StaffVisitAadeshDetails::class, 'aadesh_no', 'aadesh_no');
    }

    public function staffVisitBill()
    {
        return $this->hasMany(StaffVisitBill::class, 'aadesh_no', 'aadesh_no');
    }
}
