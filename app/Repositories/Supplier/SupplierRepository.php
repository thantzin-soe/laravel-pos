<?php

namespace App\Repositories\Supplier;

use App\Models\Supplier;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Repositories\BaseRepository;
use DataTables;
use Illuminate\Support\Facades\Storage;

/**
 * Class SupplierRepository.
 */
class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Supplier $model
     */
    public function __construct(Supplier $model)
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
                ->addColumn('action', function (Supplier $supplier) {
                    return view('backend.supplier.datatable.action')->with('supplier', $supplier);
                })
                ->editColumn('image', function (Supplier $supplier) {
                    return "<img src='".$supplier->image_url."' style='width:50px;height:40px'>";
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
    }

    public function delete($id): bool
    {
        $supplier = $this->findById($id);
        if ($supplier->image) {
            Storage::disk('cloudinary')->delete($supplier->image);
        }
        return $supplier->delete();
    }
}
