<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Button } from "@/Components/ui/button";
import { Link, router } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { ArrowLeft, Trash2 } from "lucide-vue-next";
import { formatDateTime } from "@/lib/date";

const props = defineProps({
    lead: Object,
    activity: Object,
});

const deleteActivity = () => {
    if (!confirm("Are you sure you want to delete this activity?")) return;

    router.delete(
        route('leads.activities.destroy', [props.lead.id, props.activity.id])
    );
};
</script>

<template>
    <AppLayout>
        <div class="rounded-lg border bg-card p-6 space-y-6">

            <!-- HEADER -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <Link :href="route('leads.show', lead.id)"
                        class="flex items-center gap-1 text-sm text-muted-foreground hover:text-foreground transition">
                        <ArrowLeft class="h-4 w-4" />
                        Back to Lead
                    </Link>

                    <h1 class="text-lg font-semibold">Activity Details</h1>
                </div>

                <div class="flex gap-2">
                    <Link :href="route('leads.activities.edit', [lead.id, activity.id])">
                        <Button variant="outline">
                            Edit
                        </Button>
                    </Link>

                    <Button variant="destructive" @click="deleteActivity">
                        <Trash2 class="h-4 w-4 mr-1" />
                        Delete
                    </Button>
                </div>
            </div>

            <!-- DETAILS -->
            <div class="grid grid-cols-4 gap-6 text-sm">

                <div class="col-span-2">
                    <p class="text-muted-foreground">Subject</p>
                    <p class="font-medium">{{ activity.subject }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Type</p>
                    <p class="capitalize">{{ activity.type }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Status</p>
                    <p class="capitalize">{{ activity.status }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Scheduled At</p>
                    <p>{{ formatDateTime(activity.scheduled_at) }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Duration (minutes)</p>
                    <p>{{ activity.duration_minutes ?? "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Assigned To</p>
                    <p>{{ activity.assigned_user?.name || "-" }}</p>
                </div>

                <div class="col-span-4">
                    <p class="text-muted-foreground mb-1">Description</p>
                    <div class="rounded-md border bg-muted/30 p-3 min-h-[80px]">
                        {{ activity.description || "No description added" }}
                    </div>
                </div>

            </div>

        </div>
    </AppLayout>
</template>
