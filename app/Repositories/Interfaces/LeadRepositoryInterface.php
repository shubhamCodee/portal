<?php

namespace App\Repositories\Interfaces;

use App\Models\Lead;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LeadRepositoryInterface
{
    public function getPaginatedLeads(
        array $filters = [],
        int $perPage = 15
    ): LengthAwarePaginator;

    public function getLeadById(int $id): ?Lead;

    public function createLead(array $data): Lead;

    public function updateLead(Lead $lead, array $data): Lead;

    public function deleteLead(Lead $lead): bool;
}
