<?php

namespace App\Repositories\Employee;

use App\Models\Employee;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class EmployeeRepository.
 */
class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Employee $model
     */
    public function __construct(Employee $model)
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
}
