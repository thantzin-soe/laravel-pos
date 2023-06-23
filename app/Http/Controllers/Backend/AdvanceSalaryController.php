<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdvanceSalary\AdvanceSalaryStoreRequest;
use App\Http\Requests\AdvanceSalary\AdvanceSalaryUpdateRequest;
use App\Models\AdvanceSalary;
use App\Repositories\AdvanceSalary\AdvanceSalaryRepositoryInterface;

class AdvanceSalaryController extends Controller
{
    private $advanceSalaryRepository;

    public function __construct(AdvanceSalaryRepositoryInterface $advanceSalaryRepository)
    {
        $this->advanceSalaryRepository = $advanceSalaryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->advanceSalaryRepository->getDataTable();
        }

        return view('backend.advance_salary.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.advance_salary.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdvanceSalaryStoreRequest $request)
    {
        $advance_salary = AdvanceSalary::where('month', $request->month)->where('year', $request->year)->where('employee_id', $request->employee_id)->first();

        if ($advance_salary === null) {
            $this->advanceSalaryRepository->create($request->validated());

            $notification = [
                'message' => 'Advance salary paid successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('advance_salaries.index')->with($notification);
        } else {
            $notification = [
                'message' => 'Advance salary already paid',
                'alert-type' => 'warning'
            ];

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdvanceSalary $advance_salary)
    {
        return view('backend.advance_salary.edit', compact('advance_salary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdvanceSalaryUpdateRequest $request, AdvanceSalary $advance_salary)
    {
        if ($advance_salary->month == $request->month) {
            $old_advance_salary = null;
        } else {
            $old_advance_salary = AdvanceSalary::where('month', $request->month)->where('year', $request->year)->where('employee_id', $request->employee_id)->first();
        }


        if ($old_advance_salary === null) {
            $this->advanceSalaryRepository->update($advance_salary->id, $request->validated());

            $notification = [
                'message' => 'Advance salary updated successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('advance_salaries.index')->with($notification);
        } else {
            $notification = [
                'message' => 'Advance salary already paid',
                'alert-type' => 'warning'
            ];

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $ad)
    {
        $this->advanceSalaryRepository->delete($id);

        $notification = [
            'message' => 'Advance Salary deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('advance_salaries.index')->with($notification);
    }
}
