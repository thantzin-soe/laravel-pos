<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findById($id): Model
    {
        return $this->model->where('id', $id)->firstOrFail();
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes): Model
    {
        $model = $this->findById($id);
        $model->update($attributes);
        return $model;
    }

    public function delete($id): bool
    {
        return $this->findById($id)->delete();
    }
}
