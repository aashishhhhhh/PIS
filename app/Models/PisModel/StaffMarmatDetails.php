<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffMarmatDetails extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_marmat_details';

    protected $fillable = [
        'date',
        'staff_detail_date',
        'sakha_pramukh_name',
        'sakha_pramukh_position',
        'sakha_pramukh_date',
        'sakha_prawidhik_name',
        'sakha_prawidhik_position',
        'sakha_prawidhik_date',
        'karylaya_pramukh_name',
        'karylaya_pramukh_position',
        'karylaya_pramukh_date',
        'marmat_form_no',
        'is_verified'
    ];

    public function marmat()
    {
        return $this->hasMany(StaffMarmat::class, 'marmat_form_no', 'marmat_form_no');
    }
}
