<?php

namespace HRis\PIM\Http\Controllers;

use Illuminate\Http\Request;
use HRis\PIM\Eloquent\Employee;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    /**
     * Export all employees.
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function export(Request $request): StreamedResponse
    {
        $fileName = 'employees.csv';
        $employees = Employee::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('First Name', 'Middle Name', 'Last Name');

        $callback = function() use($employees, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($employees as $employee) {
                $row['First Name'] = $employee->first_name;
                $row['Middle Name'] = $employee->middle_name;
                $row['Last Name'] = $employee->last_name;

                fputcsv($file, array($row['First Name'], $row['Middle Name'], $row['Last Name']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
