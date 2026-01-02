<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LeadController extends Controller
{
    public function __construct(
        protected LeadRepositoryInterface $leadRepository
    ) {}

    public function index(Request $request)
    {
        $leads = $this->leadRepository->getAllLeads(
            $request->only(['status', 'source'])
        );

        return Inertia::render('Leads/Index', [
            'leads' => $leads,
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

        return redirect()->route('leads.index');
    }

    public function show(int $id)
    {
        $lead = $this->leadRepository->getLeadById($id);

        return Inertia::render('Leads/Show', [
            'lead' => $lead,
        ]);
    }

    public function edit(int $id)
    {
        $lead = $this->leadRepository->getLeadById($id);

        return Inertia::render('Leads/Edit', [
            'lead' => $lead,
        ]);
    }

    public function update(UpdateLeadRequest $request, int $id)
    {
        $lead = $this->leadRepository->getLeadById($id);

        $this->leadRepository->updateLead(
            $lead,
            $request->validated()
        );

        return redirect()->route('leads.index');
    }

    public function destroy(int $id)
    {
        $lead = $this->leadRepository->getLeadById($id);

        $this->leadRepository->deleteLead($lead);

        return redirect()->route('leads.index');
    }
}
