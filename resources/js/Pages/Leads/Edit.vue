<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";
import FormRenderer from "@/Components/Forms/FormRenderer.vue";
import { leadFormSchema } from "@/Forms/leadFormSchema";
import { route } from "ziggy-js";
import {
    formatDateForInput,
    formatDateTimeForInput,
} from "@/lib/date";

const props = defineProps({
    lead: Object,
});

const form = useForm({
    name: props.lead.name ?? "",
    company_name: props.lead.company_name ?? "",
    first_name: props.lead.first_name ?? "",
    last_name: props.lead.last_name ?? "",
    email: props.lead.email ?? "",
    phone: props.lead.phone ?? "",
    website: props.lead.website ?? "",
    status: props.lead.status ?? "",
    source: props.lead.source ?? "",
    lost_reason: props.lead.lost_reason ?? "",
    department: props.lead.department ?? "",
    designation: props.lead.designation ?? "",
    industry: props.lead.industry ?? "",
    lead_cost: props.lead.lead_cost ?? "",
    total_lead_cost: props.lead.total_lead_cost ?? "",
    currency: props.lead.currency ?? "INR",
    percentage: props.lead.percentage ?? "",
    tags: props.lead.tags ?? [],
    follow_up_date: props.lead.follow_up_date
        ? formatDateForInput(props.lead.follow_up_date)
        : "",
    follow_up_time: props.lead.follow_up_time ?? "",
    meeting_at: props.lead.meeting_at
        ? formatDateTimeForInput(props.lead.meeting_at)
        : "",
    closed_date: props.lead.closed_date
        ? formatDateForInput(props.lead.closed_date)
        : "",
    address: props.lead.address ?? "",
    city: props.lead.city ?? "",
    state: props.lead.state ?? "",
    country: props.lead.country ?? "",
    postal_code: props.lead.postal_code ?? "",
    notes: props.lead.notes ?? "",
    is_active: props.lead.is_active ?? true,
});

const submit = () => {
    form.put(route("leads.update", props.lead.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout>
        <div class="flex flex-col gap-4">

            <div class="flex items-center justify-between">
                <h1 class="text-lg font-semibold">Edit Lead</h1>
            </div>

            <div class="rounded-lg border bg-card p-4">
                <form @submit.prevent="submit" class="grid grid-cols-4 gap-4">
                    <FormRenderer :schema="leadFormSchema" :form="form" :errors="form.errors" />
                    <div class="col-span-4 flex justify-end pt-2">
                        <Button type="submit" :disabled="form.processing">
                            Update Lead
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
