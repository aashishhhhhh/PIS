<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffTaskAssign extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'staff_task_assign';

    protected $fillable = [
        'staff_task_id',
        'staff_id'
    ];

    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function tasks()
    {
        return $this->belongsTo(StaffTask::class, 'staff_task_id', 'id');
    }
}
