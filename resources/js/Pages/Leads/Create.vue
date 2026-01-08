<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";
import FormRenderer from "@/Components/Forms/FormRenderer.vue";
import { leadFormSchema } from "@/Forms/leadFormSchema";
import { route } from "ziggy-js";
import { computed } from "vue";

const props = defineProps({
    users: Array,
});


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

    // Assignment
    assigned_to_user_id: null,

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

const computedSchema = computed(() => {
    return leadFormSchema.map((field) => {
        if (field.name === "assigned_to_user_id") {
            return {
                ...field,
                props: {
                    ...field.props,
                    options: props.users.map((user) => ({
                        label: user.name,
                        value: user.id,
                    })),
                },
            };
        }

        return field;
    });
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

            <div class="rounded-lg border bg-card p-4">
                <form @submit.prevent="submit" class="grid grid-cols-4 gap-4">
                    <FormRenderer :schema="computedSchema" :form="form" :errors="form.errors" />
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
