<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleTask extends BaseModel
{
    use HasFactory;

    protected $fillable=['class','schedule_date','schedule_time','type','student_code','is_active','status','is_sent','created_by','updated_by'];
}
