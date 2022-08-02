<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staffs';

    protected $fillable = [
        'user_id',
        'name',
        's_no',
        'nep_name',
        'dob',
        'cs_no',
        'cs_district',
        'cs_issue',
        'father_name',
        'father_nep_name',
        'father_occupation',
        'g_father_name',
        'g_father_nep_name',
        'g_father_occupation',
        'mother_name',
        'mother_nep_name',
        'mother_occupation',
        'spouse_name',
        'spouse_nep_name',
        'spouse_occupation',
        'daughters_no',
        'sons_no',
        'category_id',
        'sub_category_id',
        'photo',
        'sanstha_darta_no',
        'pyan_no',
        'is_verified',
        'is_approved'
    ];
}
