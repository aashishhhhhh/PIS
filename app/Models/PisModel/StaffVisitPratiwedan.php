<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffVisitPratiwedan extends Model
{
    use HasFactory;

    protected $connection = 'mysql_pis';

    protected $table = 'staff_visit_pratiwedan';

    protected $fillable = [
        'aadesh_no',
        'team_leader',
        'visit_duration',
        'visit_udasya',
        'mukhya_kaam',
        'sikai_upalabdi',
        'suggestion',
        'visit_paper_details',
        'staff_id'
    ];
}
