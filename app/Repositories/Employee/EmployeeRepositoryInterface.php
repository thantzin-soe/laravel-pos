<?php

namespace App\Repositories\Employee;

use App\Repositories\BaseRepositoryInterface;

interface EmployeeRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();

    public function paginate($size = 10);
}
