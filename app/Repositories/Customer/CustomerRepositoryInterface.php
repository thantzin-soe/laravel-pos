<?php

namespace App\Repositories\Customer;

use App\Repositories\BaseRepositoryInterface;

interface CustomerRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();

    public function paginate($size = 10);
}
