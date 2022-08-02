<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffVisitBill extends Model
{
    use HasFactory;

    protected $connection = 'mysql_pis';

    protected $table = 'staff_visit_bill';

    protected $fillable = [
        'aadesh_no',
        'destination_no',
        'prasthan_place',
        'prasthan_date',
        'pahuch_place',
        'pahuch_date',
        'visit_vehicle',
        'visit_expense',
        'bhatta_day',
        'bhatta_rate',
        'bhatta_total',
        'futkar_detail',
        'futkar_total',
        'all_total',
        'remarks',
        'bhraman_total',
        'bhatta_total_all',
        'futkat_total_all',
        'total_all_all',
        'karmachari_date',
        'jaach_date',
        'swikrit_date',
        'bhraman_peski',
        'khud_bhuktani',
        'swikrit_amount'
    ];
}
