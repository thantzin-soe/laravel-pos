<?php

namespace App\Repositories\AdvanceSalary;

use App\Models\AdvanceSalary;
use App\Repositories\AdvanceSalary\AdvanceSalaryRepositoryInterface;
use App\Repositories\BaseRepository;
use DataTables;
use Illuminate\Support\Facades\Storage;

/**
 * Class AdvanceSalaryRepository.
 */
class AdvanceSalaryRepository extends BaseRepository implements AdvanceSalaryRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param AdvanceSalary $model
     */
    public function __construct(AdvanceSalary $model)
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
        return Datatables::of($this->model->with(['employee'])->orderBy('id', 'DESC'))->addIndexColumn()
                ->addColumn('action', function (AdvanceSalary $advance_salary) {
                    return view('backend.advance_salary.datatable.action')->with('advance_salary', $advance_salary);
                })
                ->editColumn('image', function (AdvanceSalary $advance_salary) {
                    return "<img src='".$advance_salary->employee->image_url."' style='width:50px;height:40px'>";
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
    }

    public function delete($id): bool
    {
        $advance_salary = $this->findById($id);
        if ($advance_salary->image) {
            Storage::disk('cloudinary')->delete($advance_salary->image);
        }
        return $supplier->delete();
    }
}
