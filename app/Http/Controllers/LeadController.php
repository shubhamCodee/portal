<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Lead;

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
        return Inertia::render('Leads/Create');
    }

    public function store(StoreLeadRequest $request)
    {
        $this->leadRepository->createLead(
            $request->validated()
        );

        return redirect()
            ->route('leads.index')
            ->with('success', 'Lead created successfully.');
    }

    public function show(Lead $lead)
    {
        return Inertia::render('Leads/Show', [
            'lead' => $lead,
        ]);
    }

    public function edit(Lead $lead)
    {
        return Inertia::render('Leads/Edit', [
            'lead' => $lead,
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
