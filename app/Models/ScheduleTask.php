<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleTask extends BaseModel
{
    use HasFactory;

    protected $fillable = ['class_student_code', 'schedule_date', 'schedule_time', 'type', 'is_active', 'status', 'is_sent', 'created_by', 'updated_by'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_sent'   => 'boolean'
    ];
}
