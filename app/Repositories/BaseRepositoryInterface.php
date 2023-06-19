<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function findById($id): Model;

    public function create(array $attributes): Model;

    public function update($slug, array $data): Model;

    public function delete($slug): bool;
}
