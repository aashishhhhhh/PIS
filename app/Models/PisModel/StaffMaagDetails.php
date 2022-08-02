<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffMaagDetails extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'staff_maag_details';

    protected $fillable = [
        'print_date',
        'maag_date',
        'prayojan',
        'sifarish_garneko_name',
        'sifarish_date',
        'aadesh_date',
        'maal_saman_bujeko_date',
        'jinsi_khata_date',
        'maag_no',
        'is_verified',
        'is_approved'
    ];

    public function maag()
    {
        return $this->hasMany(StaffMaag::class, 'maag_no', 'maag_no');
    }
}
