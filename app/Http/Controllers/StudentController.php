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
        $request->validate([
            'student_file' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        try {
            // Import data from the excel or csv file and save it to database
            Excel::import(new StudentImport, $request->file('student_file'));
            return $this->success(200, 'students added successfully');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            // Display validation error messages
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Row ' . $failure->row() . ': ' . implode(' ', $failure->errors());
            }

            return $errorMessages;
        }catch (\Exception $e) {
            return $this->error(500, $e->getMessage());
        }
    }
}
