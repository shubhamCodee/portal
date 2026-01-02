<script setup>
import AppLayout from "@/Layouts/AppLayout.vue"
import { Button } from "@/Components/ui/button"
import { Link } from "@inertiajs/vue3"
import { route } from "ziggy-js"
import { formatDate, formatDateTime, formatTime } from "../../lib/date.js"
import { ArrowLeft } from "lucide-vue-next"

const props = defineProps({
    lead: Object,
})
</script>

<template>
    <AppLayout>
        <div class="rounded-lg border bg-card p-6 space-y-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <Link :href="route('leads.index')"
                        class="flex items-center gap-1 text-sm text-muted-foreground hover:text-foreground transition">
                        <ArrowLeft class="h-4 w-4" />
                    </Link>

                    <h1 class="text-lg font-semibold">Lead Details</h1>
                </div>

                <Link :href="route('leads.edit', lead.id)">
                    <Button variant="outline">
                        Edit Lead
                    </Button>
                </Link>
            </div>


            <div class="grid grid-cols-2 gap-6 text-sm">
                <div>
                    <p class="text-muted-foreground">Name</p>
                    <p class="font-medium">{{ lead.name }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Email</p>
                    <p class="font-medium">{{ lead.email ?? "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Phone</p>
                    <p class="font-medium">{{ lead.phone ?? "-" }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Status</p>
                    <p class="capitalize font-medium">{{ lead.status }}</p>
                </div>

                <div>
                    <p class="text-muted-foreground">Source</p>
                    <p class="capitalize font-medium">{{ lead.source ?? "-" }}</p>
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
                        {{ formatDate(lead.follow_up_date ?? "-") }}
                    </p>
                </div>

                <div>
                    <p class="text-muted-foreground">Follow-up Time</p>
                    <p class="font-medium">
                        {{ formatTime(lead.follow_up_time ?? "-") }}
                    </p>
                </div>

                <div>
                    <p class="text-muted-foreground">Meeting At</p>
                    <p class="font-medium">
                        {{ formatDateTime(lead.meeting_at ?? "-") }}
                    </p>
                </div>

                <div>
                    <p class="text-muted-foreground">Status</p>
                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium" :class="lead.is_active
                        ? 'bg-green-100 text-green-700'
                        : 'bg-red-100 text-red-700'">
                        {{ lead.is_active ? "Active" : "Inactive" }}
                    </span>
                </div>

                <div class="col-span-2">
                    <p class="text-muted-foreground mb-1">Notes</p>
                    <div class="rounded-md border bg-muted/30 p-3 min-h-[80px]">
                        <p v-if="lead.notes">
                            {{ lead.notes }}
                        </p>
                        <p v-else class="text-muted-foreground">
                            No notes added
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
