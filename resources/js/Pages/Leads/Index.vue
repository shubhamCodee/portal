<script setup>
import { ref, watch } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Button } from "@/Components/ui/button";
import { Plus, Pencil, Trash2 } from "lucide-vue-next";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table";
import {
    Select,
    SelectTrigger,
    SelectValue,
    SelectContent,
    SelectItem,
} from "@/Components/ui/select";
import { route } from "ziggy-js";
import { formatDate } from "../../lib/date.js";

defineProps({
    leads: Array,
});

const status = ref("");
const source = ref("");

watch([status, source], ([newStatus, newSource]) => {
    router.get(
        route("leads.index"),
        {
            status: newStatus,
            source: newSource,
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        }
    );
});

const goToShow = (id) => {
    router.visit(route("leads.show", id));
};
</script>


<template>
    <AppLayout>
        <div class="rounded-lg border bg-card p-4">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-lg font-semibold">Leads</h1>

                <Link :href="route('leads.create')">
                    <Button>
                        <Plus class="h-4 w-4 mr-2" />
                        Create Lead
                    </Button>
                </Link>
            </div>

            <div class="flex gap-4 mb-4">
                <Select v-model="status">
                    <SelectTrigger class="w-[220px]">
                        <SelectValue placeholder="Select Status" />
                    </SelectTrigger>

                    <SelectContent>
                        <SelectItem value="new">New</SelectItem>
                        <SelectItem value="contacted">Contacted</SelectItem>
                        <SelectItem value="qualified">Qualified</SelectItem>
                        <SelectItem value="converted">Converted</SelectItem>
                        <SelectItem value="lost">Lost</SelectItem>
                    </SelectContent>
                </Select>

                <Select v-model="source">
                    <SelectTrigger class="w-[220px]">
                        <SelectValue placeholder="Select Source" />
                    </SelectTrigger>

                    <SelectContent>
                        <SelectItem value="website">Website</SelectItem>
                        <SelectItem value="referral">Referral</SelectItem>
                        <SelectItem value="cold-call">Cold Call</SelectItem>
                        <SelectItem value="ads">Ads</SelectItem>
                    </SelectContent>
                </Select>
            </div>


            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Name</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead>Source</TableHead>
                        <TableHead>Follow-up Date</TableHead>
                        <TableHead class="text-right">Actions</TableHead>
                    </TableRow>
                </TableHeader>

                <TableBody>
                    <TableRow v-if="leads.length === 0">
                        <TableCell colspan="5" class="text-center py-12 text-muted-foreground">
                            <div class="flex flex-col items-center gap-3">
                                <p class="text-sm">No leads found</p>

                                <Link :href="route('leads.create')">
                                    <Button variant="outline" size="sm">
                                        <Plus class="h-4 w-4 mr-2" />
                                        Create your first lead
                                    </Button>
                                </Link>
                            </div>
                        </TableCell>
                    </TableRow>

                    <TableRow v-else v-for="lead in leads" :key="lead.id" class="cursor-pointer hover:bg-muted/50"
                        @click="goToShow(lead.id)">
                        <TableCell class="font-medium">
                            {{ lead.name }}
                        </TableCell>

                        <TableCell class="capitalize">
                            {{ lead.status }}
                        </TableCell>

                        <TableCell class="capitalize">
                            {{ lead.source ?? "-" }}
                        </TableCell>

                        <TableCell>
                            {{ formatDate(lead.follow_up_date ?? "-") }}
                        </TableCell>

                        <TableCell class="text-right flex justify-end gap-2">
                            <Link :href="route('leads.edit', lead.id)" @click.stop>
                                <Button variant="outline" size="icon">
                                    <Pencil class="h-4 w-4" />
                                </Button>
                            </Link>

                            <Link :href="route('leads.destroy', lead.id)" method="delete" as="button" preserve-scroll
                                @click.stop>
                                <Button variant="destructive" size="icon" type="button">
                                    <Trash2 class="h-4 w-4" />
                                </Button>
                            </Link>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
