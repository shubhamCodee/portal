<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Lead;
use App\Models\User;

class LeadController extends Controller
{
    protected LeadRepositoryInterface $leadRepository;

    public function __construct(LeadRepositoryInterface $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'status',
            'source',
        ]);

        $leads = $this->leadRepository->getPaginatedLeads(
            $filters,
            15
        );

        return Inertia::render('Leads/Index', [
            'leads' => $leads,
            'filters' => $filters,
        ]);
    }

    public function create()
    {
        $users = User::query()
            ->where('is_active', true)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return Inertia::render('Leads/Create', [
            'users' => $users,
        ]);
    }


    public function store(StoreLeadRequest $request)
    {
        $data = $request->validated();

        if (empty($data['name'])) {
            $data['name'] = trim(
                ($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '')
            );
        }

        $this->leadRepository->createLead($data);

        return redirect()
            ->route('leads.index')
            ->with('success', 'Lead created successfully.');
    }


    public function show(Lead $lead)
    {
        $lead->load([
            'assignedUser',
            'activities.assignedUser',
        ]);

        return Inertia::render('Leads/Show', [
            'lead' => $lead,
        ]);
    }



    public function edit(Lead $lead)
    {
        $users = User::query()
            ->where('is_active', true)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return Inertia::render('Leads/Edit', [
            'lead' => $lead,
            'users' => $users,
        ]);
    }


    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $this->leadRepository->updateLead(
            $lead,
            $request->validated()
        );

        return redirect()
            ->route('leads.index')
            ->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead)
    {
        $this->leadRepository->deleteLead($lead);

        return redirect()
            ->route('leads.index')
            ->with('success', 'Lead deleted successfully.');
    }
}
