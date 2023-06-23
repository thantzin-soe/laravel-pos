<?php

namespace App\Repositories\AdvanceSalary;

use App\Repositories\BaseRepositoryInterface;

interface AdvanceSalaryRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();

    public function paginate($size = 10);
}
