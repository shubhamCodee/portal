<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";
import FormRenderer from "@/Components/Forms/FormRenderer.vue";
import { leadFormSchema } from "@/Forms/leadFormSchema";
import { route } from "ziggy-js";

const form = useForm({
    // Basic identity
    name: "",
    company_name: "",
    first_name: "",
    last_name: "",

    // Contact
    email: "",
    phone: "",
    website: "",

    // Status & source
    status: "",
    source: "",
    lost_reason: "",

    // Organization
    department: "",
    designation: "",
    industry: "",

    // Financial
    lead_cost: "",
    total_lead_cost: "",
    currency: "INR",
    percentage: "",

    // Tags / classification
    tags: [],

    // Dates & follow-ups
    follow_up_date: "",
    follow_up_time: "",
    meeting_at: "",
    closed_date: "",

    // Location
    address: "",
    city: "",
    state: "",
    country: "",
    postal_code: "",

    // Notes & meta
    notes: "",
    is_active: true,
});

const submit = () => {
    form.post(route("leads.store"), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout>
        <div class="flex flex-col gap-4">

            <!-- HEADER -->
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-semibold">Create Lead</h1>
            </div>

            <!-- FORM CARD -->
            <div class="rounded-lg border bg-card p-4">
                <form @submit.prevent="submit" class="grid grid-cols-4 gap-4">
                    <!-- Dynamic fields -->
                    <FormRenderer :schema="leadFormSchema" :form="form" :errors="form.errors" />

                    <!-- ACTIONS -->
                    <div class="col-span-4 flex justify-end pt-2">
                        <Button type="submit" :disabled="form.processing">
                            Create Lead
                        </Button>
                    </div>
                </form>
            </div>

        </div>
    </AppLayout>
</template>
