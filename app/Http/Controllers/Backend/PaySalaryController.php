<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\PaySalary;
use DataTables;
use App\Repositories\Employee\EmployeeRepositoryInterface;

class PaySalaryController extends Controller
{
    private $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->middleware('permission:salary.all', ['only' => ['index']]);
        $this->middleware('permission:salary.pay', ['only' => ['paySalary']]);
        $this->middleware('permission:salary.paid', ['only' => ['paidSalary']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $now = now();
            $last_month = $now->subMonth(1)->format('F');
            $year = $now->subMonth(1)->format('Y');

            return Datatables::of(Employee::with([
                    'advance_salary' => function ($query) use ($request, $last_month, $year) {
                        if ($request->month && $request->year) {
                            return $query->where('month', $request->month)->where('year', $request->year);
                        } else {
                            return $query->where('month', $last_month)->where('year', $year);
                        }
                    },
                    'pay_salary' => function ($query) use ($request, $last_month, $year) {
                        if ($request->month && $request->year) {
                            return $query->where('month', $request->month)->where('year', $request->year);
                        } else {
                            return $query->where('month', $last_month)->where('year', $year);
                        }
                    },
                ])->orderBy('id', 'DESC'))
                ->addIndexColumn()
                ->addColumn('action', function (Employee $employee) use ($request, $last_month, $year) {
                    $data = [
                        'employee' => $employee
                    ];

                    if ($employee->advance_salary->first()) {
                        $data['month'] = $employee->advance_salary->first()->month;
                        $data['year'] = $employee->advance_salary->first()->year;
                    } else {
                        $data['month'] = $last_month;
                        $data['year'] = $year;
                    }

                    if ($employee->pay_salary->first()) {
                        $data['pay_salary'] = $employee->pay_salary->first();
                    } else {
                        $data['pay_salary'] = null;
                    }

                    return view('backend.salary.datatable.action')->with($data);
                })
                ->addColumn('month', function (Employee $employee) use ($request, $last_month) {
                    if ($request->month) {
                        return "<span class='badge bg-primary'>".$request->month."</span>";
                    } else {
                        return "<span class='badge bg-primary'>".$last_month."</span>";
                    }
                })
                ->editColumn('due_salary', function (Employee $employee) {
                    if ($employee->advance_salary->first()) {
                        return $employee->salary - $employee->advance_salary->first()->advance_salary;
                    } else {
                        return $employee->salary;
                    }
                })
                ->editColumn('advance_salary', function (Employee $employee) {
                    $advance_salary =  $employee->advance_salary->first();
                    if (!$advance_salary) {
                        return [
                            'advance_salary' => 'No Advance'
                        ];
                    }
                    if ($advance_salary) {
                        return $advance_salary->toArray();
                    }
                })
                ->editColumn('image', function (Employee $employee) {
                    return "<img src='".$employee->image_url."' style='width:50px;height:40px'>";
                })
                ->rawColumns(['action', 'image', 'month'])
                ->make(true);
        }
        return view('backend.salary.index');
    }


    public function paySalary(Request $request, string $year, string $month, Employee $employee)
    {
        $employee->load(['advance_salary' => function ($query) use ($request) {
            return $query->where('month', $request->month)->where('year', $request->year);
        }]);

        $advance_salary = $employee->advance_salary->first();

        return view('backend.salary.pay', compact('employee', 'month', 'year', 'advance_salary'));
    }

    public function paidSalary(Request $request, Employee $employee)
    {
        PaySalary::create([
            'employee_id' => $employee->id,
            'month' => $request->month,
            'year' => $request->year,
            'paid_amount' => $request->paid_amount,
            'advance_salary' => $request->advance_salary ?? 0,
            'due_salary' => $request->due_salary
        ]);

        $notification = [
            'message' => 'Salary paid successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('salaries.index')->with($notification);
    }
}
