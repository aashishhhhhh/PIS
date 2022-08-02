<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class StaffMarmatStoreKeeper extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'staff_marmat_storekeeper';

    protected $fillable = [
        'sanket_no',
        'has_warranty',
        'before_marmat_times',
        'before_marmat_date',
        'before_marmat_price',
        'marmat_form_no',
    ];
}
