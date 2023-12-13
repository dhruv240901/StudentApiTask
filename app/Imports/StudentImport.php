<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $student = Student::where('student_code', $row['student_code'])->first();
        if (!$student) {
            return new Student([
                "student_code" => $row['student_code'],
                "name"         => $row['name'],
                "email"        => $row['email'],
                "gender"       => $row['gender'],
                "parent_name"  => $row['parent_name'],
                "standard"     => $row['standard'],
                "city"         => $row['city'],
                "state"        => $row['state'],
                "pincode"      => $row['pincode'],
            ]);
        }
    }

    public function validate(): array
    {
        return [
            'student_code' => 'required|unique:students,student_code',
            'name'         => 'required|string',
            'email'        => 'required|email',
            'gender'       => 'required|in:male,female,other',
            "parent_name"  => 'required|string',
            'standard'     => 'required|integer|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'city'         => 'required|string',
            'state'        => 'required|string',
            'pincode'      => 'required|numeric|size:6',
        ];
    }
}
