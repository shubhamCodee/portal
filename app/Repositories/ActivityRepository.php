<?php

namespace App\Repositories;

use App\Models\Activity;
use App\Repositories\Interfaces\ActivityRepositoryInterface;
use Illuminate\Support\Collection;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function getByLead(int $leadId): Collection
    {
        return Activity::query()
            ->where('lead_id', $leadId)
            ->with('assignedUser')
            ->latest('scheduled_at')
            ->get();
    }

    public function findById(int $id): ?Activity
    {
        return Activity::with(['lead', 'assignedUser'])->find($id);
    }

    public function create(array $data): Activity
    {
        return Activity::create($data);
    }

    public function update(Activity $activity, array $data): Activity
    {
        $activity->update($data);

        return $activity;
    }

    public function delete(Activity $activity): bool
    {
        return $activity->delete();
    }
}
