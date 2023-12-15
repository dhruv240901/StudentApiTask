<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportStudent implements FromCollection, WithHeadings
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if($this->request['export_by']=='filename'){
            return Student::with('result')->select('student_code','name','email','gender','parent_name','standard','city','state','pincode')->where('filename',$this->request['filename'])->get();
        }

        if($this->request['export_by']=='class'){
            return Student::with('result')->select('student_code','name','email','gender','parent_name','standard','city','state','pincode')->where('standard',$this->request['class'])->get();
        }
    }

    public function headings(): array
    {
        // Specify column names here
        return [
            'student_code',
            'name',
            'email',
            'gender',
            'parent_name',
            'standard',
            'city',
            'state',
            'pincode',
            // 'science',
            // 'maths',
            // 'english',
            // 'gujarati',
            // 'hindi'
        ];
    }
}
