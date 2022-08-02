<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffTask extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';
    protected $table = 'staff_tasks';
    protected $fillable = [
        'date',
        'task_name',
        'task_description',
        'finish_date',
        'giver_id',
        'start_date',
        'start_time',
        'finish_time',
        'has_deadline',
        'deadline_type'
    ];
    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'giver_id', 'user_id');
    }

    public function stafftasks()
    {
        return $this->belongsToMany(Staff::class, 'staff_task_assign', 'staff_task_id', 'staff_id')->withPivot('id', 'staff_id');
    }
}
