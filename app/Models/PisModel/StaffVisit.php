<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffVisit extends Model
{
    use HasFactory;

    protected $connection = 'mysql_pis';

    protected $table = 'staff_visit';

    protected $fillable = [
        'aadesh_no',
        'team_leader',
        'from_date',
        'to_date',
        'visit_udasya',
        'mukhya_kaam',
        'sikai_upalabdi',
        'suggestion',
        'visit_paper_details',
        'staff_id'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
}
