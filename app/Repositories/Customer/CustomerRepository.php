<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\BaseRepository;
use DataTables;
use Illuminate\Support\Facades\Storage;

/**
 * Class CustomerRepository.
 */
class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Customer $model
     */
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    public function paginate($size = 10)
    {
        return $this->model->paginate($size);
    }

    public function findByName($name)
    {
        return $this->model->where('name', 'LIKE', "$name%")->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getDataTable()
    {
        return Datatables::of($this->model->orderBy('id', 'DESC'))->addIndexColumn()
                ->addColumn('action', function (Customer $customer) {
                    return view('backend.customer.datatable.action')->with('customer', $customer);
                })
                ->editColumn('image', function (Customer $customer) {
                    return "<img src='".$customer->image_url."' style='width:50px;height:40px'>";
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
    }

    public function delete($id): bool
    {
        $customer = $this->findById($id);
        if ($customer->image) {
            Storage::disk('cloudinary')->delete($customer->image);
        }
        return $customer->delete();
    }
}
