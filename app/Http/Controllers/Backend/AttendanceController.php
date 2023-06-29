<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $date = $request->date ?? now()->format('Y-m-d');

            return Datatables::of(
                Employee::orderBy('name', 'ASC')
                        ->select('employees.*', 'attendances.id as attendance_id', 'attendances.date', 'attendances.status as status')
                        ->leftJoin('attendances', function ($join) use ($date) {
                            $join->on('employees.id', '=', 'attendances.employee_id');
                            $join->on('attendances.date', '=', DB::raw("'".$date."'"));
                        })
            )->addIndexColumn()
                ->addColumn('status', function (Employee $employee) {
                    return view('backend.attendance.datatable.status')->with('employee', $employee);
                })
                ->editColumn('image', function (Employee $employee) {
                    return "<img src='".$employee->image_url."' style='width:50px;height:40px'>";
                })
                ->rawColumns(['status', 'image'])
                ->make(true);
        }

        return view('backend.attendance.index');
    }

    public function save(Request $request)
    {
        $employee_count = count($request->employee_id);

        for ($i=0; $i < $employee_count; $i++) {
            $employee_id = $request->employee_id[$i];
            $attendance_status = 'attend_status'.$employee_id;

            $attendances = Attendance::updateOrCreate(
                [
                    'employee_id' => $employee_id,
                    'date' => $request->date,
                ],
                [
                    'status' => $request->$attendance_status
                ],
            );
        }

        $notification = [
            'message' => 'Attendance data saved successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
