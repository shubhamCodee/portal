<script setup>
import { ref, watch } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Button } from "@/Components/ui/button";
import { Plus, Pencil, Trash2, ChevronLeft, ChevronRight } from "lucide-vue-next";
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
import { formatDate } from "@/lib/date";

const props = defineProps({
    leads: Object,
    filters: Object,
});

const status = ref(props.filters?.status ?? "");
const source = ref(props.filters?.source ?? "");

watch([status, source], ([newStatus, newSource]) => {
    router.get(
        route("leads.index"),
        {
            status: newStatus || undefined,
            source: newSource || undefined,
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

const goToPage = (url) => {
    if (!url) return;

    router.visit(url, {
        preserveState: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout>
        <div class="rounded-lg border bg-card p-4 space-y-4">

            <div class="flex items-center justify-between">
                <h1 class="text-lg font-semibold">Leads</h1>

                <Link :href="route('leads.create')">
                    <Button>
                        <Plus class="h-4 w-4 mr-2" />
                        Create Lead
                    </Button>
                </Link>
            </div>

            <div class="flex gap-4">
                <Select v-model="status">
                    <SelectTrigger class="w-[220px]">
                        <SelectValue placeholder="Filter by Status" />
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
                        <SelectValue placeholder="Filter by Source" />
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
                    <TableRow v-if="leads.data.length === 0">
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

                    <TableRow v-else v-for="lead in leads.data" :key="lead.id" class="cursor-pointer hover:bg-muted/50"
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
                            {{ lead.follow_up_date ? formatDate(lead.follow_up_date) : "-" }}
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

            <div v-if="leads.total > leads.per_page" class="flex items-center justify-between pt-2">
                <p class="text-sm text-muted-foreground">
                    Showing
                    <span class="font-medium">{{ leads.from }}</span>
                    to
                    <span class="font-medium">{{ leads.to }}</span>
                    of
                    <span class="font-medium">{{ leads.total }}</span>
                    results
                </p>

                <div class="flex gap-2">
                    <Button variant="outline" size="icon" :disabled="!leads.prev_page_url"
                        @click="goToPage(leads.prev_page_url)">
                        <ChevronLeft class="h-4 w-4" />
                    </Button>

                    <Button variant="outline" size="icon" :disabled="!leads.next_page_url"
                        @click="goToPage(leads.next_page_url)">
                        <ChevronRight class="h-4 w-4" />
                    </Button>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
