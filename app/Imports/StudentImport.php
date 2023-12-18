<?php

namespace App\Imports;

use App\Models\File;
use App\Models\Result;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel, WithHeadingRow, WithValidation
{
    public $filename, $file;

    public function __construct($filename, $file)
    {
        $this->filename = $filename;
        $this->file     = $file;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Validation will be handled automatically
        $checkStudent = Student::where('student_code', $row['student_code'])->first();
        if (!$checkStudent) {

            // Save student data
            $student = Student::create([
                "student_code" => $row['student_code'],
                "name"         => $row['name'],
                "email"        => $row['email'],
                "gender"       => $row['gender'],
                "parent_name"  => $row['parent_name'],
                "standard"     => $row['standard'],
                "city"         => $row['city'],
                "state"        => $row['state'],
                "pincode"      => $row['pincode'],
                "file_id"      => $this->file->id
            ]);

            // Calculate total marks, percentage, and percentile
            $totalMarks = $row['science'] + $row['maths'] + $row['english'] + $row['gujarati'] + $row['hindi']; // Add other subject marks as needed
            $percentage = ($totalMarks / (5 * 100)) * 100;
            $percentile = $this->calculatePercentile($percentage);

            // Save result data
            Result::create([
                'student_id'   => $student->id,
                'science'      => $row['science'],
                'maths'        => $row['maths'],
                'english'      => $row['english'],
                'gujarati'     => $row['gujarati'],
                'hindi'        => $row['hindi'],
                'total_marks'  => $totalMarks,
                'percentage'   => $percentage,
                'percentile'   => $percentile,
                'result'       => $this->checkResultStatus($row, $percentage)
            ]);

            return $student;
        }
    }

    // Helper function to calculate percentile using the nearest-rank method
    private function calculatePercentile($percentage)
    {
        $percentiles = [10, 20, 30, 40, 50, 60, 70, 80, 90]; // Define your percentiles
        $rank = ($percentage / 100) * count($percentiles);
        $roundedRank = round($rank);

        return $percentiles[$roundedRank - 1];
    }

    // function to check result status
    private function checkResultStatus($row, $percentage)
    {
        if ($row['science'] < 33 || $row['maths'] < 33 || $row['english'] < 33 || $row['gujarati'] < 33 || $row['hindi'] < 33) {
            $result = 'Fail';
        } elseif ($percentage >= 80) {
            $result = 'First Class With Destinction';
        } elseif ($percentage >= 65) {
            $result = 'First Class';
        } elseif ($percentage >= 50) {
            $result = 'Second Class';
        } elseif ($percentage >= 33) {
            $result = 'Pass Class';
        } else {
            $result = 'Fail';
        }

        return $result;
    }

    // Validate csv or excel file data
    public function rules(): array
    {
        $rules = [
            'student_code' => 'required|regex:/^stu_\d{5}$/',
            'name'         => 'required|string',
            'email'        => 'required|email',
            'gender'       => 'required|in:male,female,other',
            "parent_name"  => 'required|string',
            'standard'     => 'required|integer|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'city'         => 'required|string',
            'state'        => 'required|string',
            'pincode'      => 'required|numeric|digits:6',
            'science'      => 'required|numeric|min:0|max:100',
            'maths'        => 'required|numeric|min:0|max:100',
            'english'      => 'required|numeric|min:0|max:100',
            'gujarati'     => 'required|numeric|min:0|max:100',
            'hindi'        => 'required|numeric|min:0|max:100',
        ];

        return $rules;
    }
}
