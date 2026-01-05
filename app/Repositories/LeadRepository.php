<?php

namespace App\Repositories;

use App\Models\Lead;
use App\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LeadRepository implements LeadRepositoryInterface
{
    public function getPaginatedLeads(
        array $filters = [],
        int $perPage = 15
    ): LengthAwarePaginator {
        return Lead::query()
            ->when(
                !empty($filters['status']),
                fn($q) => $q->where('status', $filters['status'])
            )
            ->when(
                !empty($filters['source']),
                fn($q) => $q->where('source', $filters['source'])
            )
            ->when(
                !empty($filters['is_active']),
                fn($q) => $q->where('is_active', $filters['is_active'])
            )
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
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
