<?php

namespace App\Repositories\Supplier;

use App\Repositories\BaseRepositoryInterface;

interface SupplierRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();

    public function paginate($size = 10);
}
