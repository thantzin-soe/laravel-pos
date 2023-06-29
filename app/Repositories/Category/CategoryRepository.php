<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\BaseRepository;
use DataTables;
use Illuminate\Support\Facades\Storage;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Category $model
     */
    public function __construct(Category $model)
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
                ->addColumn('action', function (Category $category) {
                    return view('backend.category.datatable.action')->with('category', $category);
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function delete($id): bool
    {
        $category = $this->findById($id);
        if ($category->image) {
            Storage::disk('cloudinary')->delete($category->image);
        }
        return $category->delete();
    }
}
