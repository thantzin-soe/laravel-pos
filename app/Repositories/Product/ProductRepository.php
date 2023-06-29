<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\BaseRepository;
use DataTables;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function paginate($size = 10)
    {
        return $this->model->paginate($size);
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function findByName($name)
    {
        return $this->model->where('name', 'LIKE', "$name%")->get();
    }

    public function getDataTable()
    {
        return Datatables::of($this->model->orderBy('id', 'DESC')->with([
                'category',
                'supplier'
            ]))
                ->addIndexColumn()
                ->addColumn('action', function (Product $product) {
                    return view('backend.product.datatable.action')->with('product', $product);
                })
                ->editColumn('image', function (Product $product) {
                    return "<img src='".$product->image_url."' style='width:50px;height:40px'>";
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
    }

    public function delete($id): bool
    {
        $product = $this->findById($id);
        if ($product->image) {
            Storage::disk('cloudinary')->delete($product->image);
        }
        return $product->delete();
    }
}
