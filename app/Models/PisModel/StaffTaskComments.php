<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffTaskComments extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'staff_task_comments';

    protected $fillable = [
        'task_assign_id',
        'comment',
        'staff_id'
    ];

    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'user_id');
    }
}
