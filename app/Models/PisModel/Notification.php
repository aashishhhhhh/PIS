<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'notifications';

    protected $fillable = [
        'event_id',
        'text',
        'is_read',
        'role_id',
        'staff_id',
        'noti_type'
    ];

    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
}
