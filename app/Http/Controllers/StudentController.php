<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    use Response;

    /* function to import file and store data in database */
    public function import(Request $request)
    {
        // Validate import file
        $validateFile = Validator::make($request->all(), [
            'student_file' => 'required|file|mimes:csv,txt,xlsx,xls',
        ]);

        if ($validateFile->fails()) {
            return $this->error(401, $validateFile->errors());
        }
        
        Excel::import(new StudentImport, $request->file('student_file'));
        return $this->success(200, 'students added successfully');
    }
}
