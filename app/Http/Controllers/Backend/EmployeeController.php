<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use Image;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use DataTables;

class EmployeeController extends Controller
{
    private $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->middleware('permission:employee.all', ['only' => ['index']]);
        $this->middleware('permission:employee.add', ['only' => ['create', 'store']]);
        $this->middleware('permission:employee.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employee.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->employeeRepository->getDataTable();
        }

        return view('backend.employee.index');
    }

    public function search(Request $request)
    {
        $data = $this->employeeRepository->findByName($request->q);

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeStoreRequest $request)
    {
        $data = $request->safe()->except(['image']);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time().'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_path = 'employee_images/'.$filename;

            $image = Image::make($file)->resize(300, 300)->encode('data-url');

            $result = cloudinary()->uploadFile($image, [
                'public_id' => $upload_path,
            ]);

            $data['image'] = $result->getPublicId();
            $data['image_url'] = $result->getSecurePath();
        }

        $this->employeeRepository->create($data);

        $notification = [
            'message' => 'New employee created successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('employees.index')->with($notification);
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
    public function edit(Employee $employee)
    {
        return view('backend.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $data = $request->safe()->except(['image']);

        if ($request->file('image')) {
            if ($employee->image) {
                Storage::disk('cloudinary')->delete($employee->image);
            }
            $file = $request->file('image');
            $filename = time().'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_path = 'employee_images/'.$filename;

            $image = Image::make($file)->resize(300, 300)->encode('data-url');

            $result = cloudinary()->uploadFile($image, [
                'public_id' => $upload_path,
            ]);

            $data['image'] = $result->getPublicId();
            $data['image_url'] = $result->getSecurePath();
        }

        $this->employeeRepository->update($employee->id, $data);

        $notification = [
            'message' => 'Employee updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('employees.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->employeeRepository->delete($id);

        $notification = [
            'message' => 'Employee deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('employees.index')->with($notification);
    }
}
