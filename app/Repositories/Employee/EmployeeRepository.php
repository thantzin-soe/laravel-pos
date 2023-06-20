<?php

namespace App\Repositories\Employee;

use App\Models\Employee;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use App\Repositories\BaseRepository;
use DataTables;
use Illuminate\Support\Facades\Storage;

/**
 * Class EmployeeRepository.
 */
class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Employee $model
     */
    public function __construct(Employee $model)
    {
        parent::__construct($model);
    }

    public function paginate($size = 10)
    {
        return $this->model->paginate($size);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getDataTable()
    {
        return Datatables::of($this->model->orderBy('id', 'DESC'))->addIndexColumn()
                ->addColumn('action', function (Employee $employee) {
                    return view('backend.employee.datatable.action')->with('employee', $employee);
                })
                ->editColumn('image', function (Employee $employee) {
                    return "<img src='".$employee->image_url."' style='width:50px;height:40px'>";
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
    }

    public function delete($id): bool
    {
        $employee = $this->findById($id);
        if ($employee->image) {
            Storage::disk('cloudinary')->delete($employee->image);
        }
        return $employee->delete();
    }
}
