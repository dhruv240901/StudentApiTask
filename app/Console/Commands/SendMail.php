<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use App\Models\ScheduleTask;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentTime = Carbon::now();
        $schedules = ScheduleTask::where('is_sent', false)->where('is_active', true)->where('schedule_date', $currentTime->format('Y-m-d'))->where('schedule_time', $currentTime->format('H:i:00'))->get();

        foreach ($schedules as $value) {
            $value->update(['status' => 'schedule']);
            if ($value->type == 'class') {
                // Send mail to whole class
                $students = Student::where('standard', $value->class)->get();
                foreach ($students as $student) {
                    $value->update(['status' => 'in_progress']);
                    dispatch(new SendMailJob($student));
                }
                $value->update(['status' => 'complete', 'is_sent' => true]);
            }

            if ($value->type == 'individual') {
                // Send mail to individual student
                $student = Student::where('student_code', $value->student_code)->first();
                $value->update(['status' => 'in_progress']);
                dispatch(new SendMailJob($student));
                $value->update(['status' => 'complete', 'is_sent' => true]);
            }

            $value->update(['status' => 'complete', 'is_sent' => true]);
        }
    }
}
