<?php

namespace App\Repositories\Interfaces;

use App\Models\Activity;
use Illuminate\Support\Collection;

interface ActivityRepositoryInterface
{
    public function getByLead(int $leadId): Collection;

    public function findById(int $id): ?Activity;

    public function create(array $data): Activity;

    public function update(Activity $activity, array $data): Activity;

    public function delete(Activity $activity): bool;
}
