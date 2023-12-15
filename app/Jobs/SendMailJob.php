<?php

namespace App\Jobs;

use App\Mail\SendStudentMail;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\ScheduleTask;
use PDF;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $student;
    /**
     * Create a new job instance.
     */
    public function __construct($student)
    {
        $this->student = $student;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Load student marksheet pdf
        $stu=$this->student;
        $pdf = PDF::loadView('pdf.result',compact('stu'));

        // Send mail to student parent
        Mail::to($this->student->email)->send(new SendStudentMail($this->student,$pdf));
    }
}
