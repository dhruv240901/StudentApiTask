<?php

namespace App\Http\Controllers;

use App\Models\ScheduleTask;
use App\Traits\Response;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    use Response;

    /* function to store schedule */
    public function store(Request $request)
    {
        // Validate schedule task data
        $request->validate([
            'class_student_code' => 'required|string',
            'schedule_date'      => 'required|date_format:Y-m-d',
            'schedule_time'      => 'required|date_format:H:i:s',
            'type'               => 'required|in:individual,class',
        ]);

        // Insert Schedule task into the database
        ScheduleTask::create($request->all());
        return $this->success(200, 'Schedule created successfully');
    }
}
