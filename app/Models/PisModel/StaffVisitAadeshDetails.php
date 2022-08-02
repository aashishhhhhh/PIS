<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffVisitAadeshDetails extends Model
{
    use HasFactory;

    protected $connection = 'mysql_pis';
    protected $table = 'staff_visit_aadesh_details';

    protected $fillable = [
        'departure_place',
        'departure_date',
        'destination_place',
        'destination_date',
        'visit_vehicle',
        'aadesh_no',
        'destination_no',
        'is_approved'
    ];
}
