<?php

namespace App\Repositories\Category;

use App\Repositories\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();

    public function paginate($size = 10);
}
