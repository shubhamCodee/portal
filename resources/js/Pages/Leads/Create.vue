<script setup>
import AppLayout from "@/Layouts/AppLayout.vue"
import { useForm } from "@inertiajs/vue3"
import { Button } from "@/Components/ui/button"
import FormRenderer from "@/Components/Forms/FormRenderer.vue"
import { leadFormSchema } from "@/Forms/leadFormSchema"

const form = useForm({
    name: "",
    email: "",
    phone: "",
    status: "",
    source: "",
    tags: [],
    follow_up_date: "",
    follow_up_time: "",
    meeting_at: "",
    notes: "",
    is_active: true,
})

const submit = () => {
    form.post(route("leads.store"))
}
</script>

<template>
    <AppLayout>
        <div class="rounded-lg border bg-card p-4 flex-1 overflow-hidden flex flex-col">
            <h1 class="text-lg font-semibold mb-3">Create Lead</h1>
            <form @submit.prevent="submit" class="grid grid-cols-2 gap-4">
                <FormRenderer :schema="leadFormSchema" :form="form" :errors="form.errors" />
                <div class="col-span-2 flex justify-end mt-2">
                    <Button type="submit">Create Lead</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
