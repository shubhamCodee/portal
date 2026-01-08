<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Button } from "@/Components/ui/button";
import { Link } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import {
    formatDate,
    formatDateTime,
    formatTime,
} from "@/lib/date";
import { ArrowLeft } from "lucide-vue-next";

defineProps({
    lead: Object,
});
</script>

<template>
    <AppLayout>
        <div class="rounded-lg border bg-card p-6 space-y-6">

            <!-- HEADER -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <Link :href="route('leads.index')"
                        class="flex items-center gap-1 text-sm text-muted-foreground hover:text-foreground transition">
                        <ArrowLeft class="h-4 w-4" />
                        Back
                    </Link>

                    <h1 class="text-lg font-semibold">Lead Details</h1>
                </div>

                <Link :href="route('leads.edit', lead.id)">
                    <Button variant="outline">Edit Lead</Button>
                </Link>
            </div>

            <!-- ACTIVITIES SECTION (ADDED, NON-DESTRUCTIVE) -->
            <div class="border-t pt-4 space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-md font-semibold">Activities</h2>

                    <Link :href="route('leads.activities.create', lead.id)">
                        <Button size="sm">Create Activity</Button>
                    </Link>
                </div>

                <div v-if="lead.activities && lead.activities.length" class="space-y-3">
                    <Link v-for="activity in lead.activities" :key="activity.id"
                        :href="route('leads.activities.show', [lead.id, activity.id])"
                        class="block rounded-md border p-4 hover:bg-muted/40 transition">

                        <div class="flex justify-between items-start">
                            <div class="space-y-1">
                                <p class="font-medium">
                                    {{ activity.subject }}
                                </p>

                                <p class="text-sm text-muted-foreground capitalize">
                                    {{ activity.type }} • {{ activity.status }}
                                </p>

                                <p class="text-sm">
                                    Scheduled:
                                    {{ formatDateTime(activity.scheduled_at) }}
                                </p>

                                <p v-if="activity.assigned_user" class="text-xs text-muted-foreground">
                                    Assigned to: {{ activity.assigned_user.name }}
                                </p>
                            </div>
                        </div>
                    </Link>
                </div>

                <p v-else class="text-sm text-muted-foreground">
                    No activities added yet.
                </p>
            </div>

            <!-- LEAD DETAILS (UNCHANGED FROM ORIGINAL) -->
            <div class="grid grid-cols-4 gap-6 text-sm border-t pt-6">

                <div>
                    <p class="text-muted-foreground">Name</p>
                    <p class="font-medium">{{ lead.name }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Company</p>
                    <p class="font-medium">{{ lead.company_name || "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">First Name</p>
                    <p class="font-medium">{{ lead.first_name || "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Last Name</p>
                    <p class="font-medium">{{ lead.last_name || "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Email</p>
                    <p class="font-medium">{{ lead.email || "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Phone</p>
                    <p class="font-medium">{{ lead.phone || "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Website</p>
                    <p class="font-medium">{{ lead.website || "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">City</p>
                    <p class="font-medium">{{ lead.city || "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Status</p>
                    <p class="font-medium capitalize">{{ lead.status }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Source</p>
                    <p class="font-medium capitalize">{{ lead.source || "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Assigned To</p>
                    <div v-if="lead.assigned_user">
                        <p class="font-medium">{{ lead.assigned_user.name }}</p>
                        <p class="text-xs text-muted-foreground">
                            {{ lead.assigned_user.email }}
                        </p>
                    </div>
                    <p v-else class="text-muted-foreground">-</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Department</p>
                    <p class="font-medium">{{ lead.department || "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Designation</p>
                    <p class="font-medium">{{ lead.designation || "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Lead Cost</p>
                    <p class="font-medium">{{ lead.lead_cost ?? "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Total Lead Cost</p>
                    <p class="font-medium">{{ lead.total_lead_cost ?? "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Currency</p>
                    <p class="font-medium">{{ lead.currency || "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Percentage</p>
                    <p class="font-medium">{{ lead.percentage ?? "-" }}%</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Tags</p>
                    <div class="flex flex-wrap gap-2 mt-1">
                        <span v-if="!lead.tags || lead.tags.length === 0" class="text-muted-foreground">
                            -
                        </span>

                        <span v-else v-for="tag in lead.tags" :key="tag"
                            class="px-2 py-1 rounded bg-muted text-xs font-medium">
                            {{ tag }}
                        </span>
                    </div>
                </div>

                <div>
                    <p class="text-muted-foreground">Follow-up Date</p>
                    <p class="font-medium">
                        {{ lead.follow_up_date ? formatDate(lead.follow_up_date) : "-" }}
                    </p>
                </div>

                <div>
                    <p class="text-muted-foreground">Follow-up Time</p>
                    <p class="font-medium">
                        {{ lead.follow_up_time ? formatTime(lead.follow_up_time) : "-" }}
                    </p>
                </div>

                <div>
                    <p class="text-muted-foreground">Meeting At</p>
                    <p class="font-medium">
                        {{ lead.meeting_at ? formatDateTime(lead.meeting_at) : "-" }}
                    </p>
                </div>

                <div>
                    <p class="text-muted-foreground">Closed Date</p>
                    <p class="font-medium">
                        {{ lead.closed_date ? formatDate(lead.closed_date) : "-" }}
                    </p>
                </div>

                <div>
                    <p class="text-muted-foreground">Active</p>
                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium" :class="lead.is_active
                        ? 'bg-green-100 text-green-700'
                        : 'bg-red-100 text-red-700'">
                        {{ lead.is_active ? "Active" : "Inactive" }}
                    </span>
                </div>

                <div class="col-span-2 col-start-1">
                    <p class="text-muted-foreground mb-1">Address</p>
                    <div class="rounded-md border bg-muted/30 p-3">
                        {{ lead.address || "-" }}
                    </div>
                </div>

                <div class="col-span-2 col-start-3">
                    <p class="text-muted-foreground mb-1">Notes</p>
                    <div class="rounded-md border bg-muted/30 p-3 min-h-[80px]">
                        {{ lead.notes || "No notes added" }}
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
