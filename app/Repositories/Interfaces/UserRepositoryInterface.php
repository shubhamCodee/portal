<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAll(): Collection;

    public function create(array $data): User;

    public function findById(int $id): User;

    public function updateById(int $id, array $data): User;

    public function deleteById(int $id): void;
}
