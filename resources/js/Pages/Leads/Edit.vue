<script setup>
import AppLayout from "@/Layouts/AppLayout.vue"
import { useForm } from "@inertiajs/vue3"
import { Button } from "@/Components/ui/button"
import FormRenderer from "@/Components/Forms/FormRenderer.vue"
import { leadFormSchema } from "@/Forms/leadFormSchema"
import { route } from "ziggy-js"
import { formatDateForInput, formatDateTimeForInput } from "../../lib/date.js"

const props = defineProps({
    lead: Object,
})

const form = useForm({
    name: props.lead.name ?? "",
    email: props.lead.email ?? "",
    phone: props.lead.phone ?? "",
    status: props.lead.status ?? "",
    source: props.lead.source ?? "",
    tags: props.lead.tags ?? [],
    follow_up_date: formatDateForInput(props.lead.follow_up_date) ?? "",
    follow_up_time: props.lead.follow_up_time ?? "",
    meeting_at: formatDateTimeForInput(props.lead.meeting_at) ?? "",
    notes: props.lead.notes ?? "",
    is_active: props.lead.is_active ?? true,
})

const submit = () => {
    form.put(route("leads.update", props.lead.id))
}
</script>

<template>
    <AppLayout>
        <div class="rounded-lg border bg-card p-4">
            <div class="mb-4">
                <h1 class="text-lg font-semibold">Edit Lead</h1>
            </div>

            <form @submit.prevent="submit" class="grid grid-cols-2 gap-4">
                <FormRenderer :schema="leadFormSchema" :form="form" :errors="form.errors" />

                <div class="col-span-2 flex justify-end pt-2">
                    <Button type="submit" :disabled="form.processing">
                        Update Lead
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
