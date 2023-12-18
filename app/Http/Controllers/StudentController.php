<?php

namespace App\Http\Controllers;

use App\Exports\ExportStudent;
use App\Imports\StudentImport;
use App\Models\File;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /* function to import file and store data in database */
    public function import(Request $request)
    {
        // Validate import file
        $request->validate([
            'student_file' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        try {
            // Get file name and pass it to Student Import
            $file = $request->file('student_file');
            $filename = $file->getClientOriginalName();

            // Save File name in files table
            $file = File::create(['name' => $filename]);

            // Import data from the excel or csv file and save it to database
            Excel::import(new StudentImport($filename,$file), $request->file('student_file'));
            return success(200, __('string.StudentAdded'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            // Display validation error messages
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Row ' . $failure->row() . ': ' . implode(' ', $failure->errors());
            }

            return $errorMessages;
        } catch (\Exception $e) {
            return error(500, $e->getMessage());
        }
    }

    /* function to export student data according to filename or class */
    public function export(Request $request)
    {
        // Validate export file request
        $request->validate([
            'export_type' => 'required|in:file,class',
            'export_by'   => 'required|string',
        ]);

        return Excel::download(new ExportStudent($request->all()), 'StudentData.csv');
    }
}
