<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Activity;
use App\Models\User;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Repositories\Interfaces\ActivityRepositoryInterface;
use Inertia\Inertia;

class ActivityController extends Controller
{
    protected ActivityRepositoryInterface $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function create(Lead $lead)
    {
        return Inertia::render('Activities/Create', [
            'lead' => $lead,
            'users' => User::select('id', 'name')
                ->where('is_active', true)
                ->get(),
        ]);
    }

    public function store(StoreActivityRequest $request, Lead $lead)
    {
        $data = $request->validated();
        $data['lead_id'] = $lead->id;

        $this->activityRepository->create($data);

        return redirect()
            ->route('leads.show', $lead->id)
            ->with('success', 'Activity created successfully.');
    }

    public function show(Lead $lead, Activity $activity)
    {
        abort_unless($activity->lead_id === $lead->id, 404);

        return Inertia::render('Activities/Show', [
            'lead' => $lead,
            'activity' => $activity->load('assignedUser'),
        ]);
    }

    public function edit(Lead $lead, Activity $activity)
    {
        abort_unless($activity->lead_id === $lead->id, 404);

        return Inertia::render('Activities/Edit', [
            'lead' => $lead,
            'activity' => $activity,
            'users' => User::select('id', 'name')
                ->where('is_active', true)
                ->get(),
        ]);
    }

    public function update(UpdateActivityRequest $request, Lead $lead, Activity $activity)
    {
        abort_unless($activity->lead_id === $lead->id, 404);

        $this->activityRepository->update(
            $activity,
            $request->validated()
        );

        return redirect()
            ->route('leads.show', $lead->id)
            ->with('success', 'Activity updated successfully.');
    }

    public function destroy(Lead $lead, Activity $activity)
    {
        abort_unless($activity->lead_id === $lead->id, 404);

        $this->activityRepository->delete($activity);

        return redirect()
            ->route('leads.show', $lead->id)
            ->with('success', 'Activity deleted successfully.');
    }
}
