<?php

namespace App\Repositories\Interfaces;

use App\Models\Lead;
use Illuminate\Support\Collection;

interface LeadRepositoryInterface
{
    public function getAllLeads(array $filters = []): Collection;

    public function getLeadById(int $id): ?Lead;

    public function createLead(array $data): Lead;

    public function updateLead(Lead $lead, array $data): Lead;

    public function deleteLead(Lead $lead): bool;
}
