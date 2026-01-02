<?php

namespace App\Repositories;

use App\Models\Lead;
use App\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Support\Collection;

class LeadRepository implements LeadRepositoryInterface
{
    public function getAllLeads(array $filters = []): Collection
    {
        return Lead::query()
            ->when(
                !empty($filters['status']),
                fn($q) => $q->where('status', $filters['status'])
            )
            ->when(
                !empty($filters['source']),
                fn($q) => $q->where('source', $filters['source'])
            )
            ->get();
    }

    public function getLeadById(int $id): ?Lead
    {
        return Lead::find($id);
    }

    public function createLead(array $data): Lead
    {
        return Lead::create($data);
    }

    public function updateLead(Lead $lead, array $data): Lead
    {
        $lead->update($data);

        return $lead;
    }

    public function deleteLead(Lead $lead): bool
    {
        return $lead->delete();
    }
}
