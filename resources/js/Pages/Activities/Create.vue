<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { Button } from '@/Components/ui/button'
import FormRenderer from '@/Components/Forms/FormRenderer.vue'
import { activityFormSchema } from '@/Forms/activityFormSchema'
import { route } from 'ziggy-js'

const props = defineProps({
    lead: Object,
    users: Array,
})

// inject users into schema options
const schema = activityFormSchema.map(field => {
    if (field.name === 'assigned_to_user_id') {
        return {
            ...field,
            props: {
                ...field.props,
                options: props.users.map(user => ({
                    label: user.name,
                    value: user.id,
                })),
            },
        }
    }
    return field
})

const form = useForm({
    assigned_to_user_id: '',
    subject: '',
    type: '',
    status: '',
    scheduled_at: '',
    duration_minutes: '',
    description: '',
})

const submit = () => {
    form.post(
        route('leads.activities.store', props.lead.id),
        { preserveScroll: true }
    )
}
</script>

<template>
    <AppLayout>
        <div class="flex flex-col gap-4 max-w-4xl mx-auto">

            <div class="flex items-center justify-between">
                <h1 class="text-lg font-semibold">
                    Create Activity for {{ lead.name }}
                </h1>
            </div>

            <div class="rounded-lg border bg-card p-4">
                <form @submit.prevent="submit" class="grid grid-cols-2 gap-4">
                    <FormRenderer :schema="schema" :form="form" :errors="form.errors" />

                    <div class="col-span-2 flex justify-end pt-2">
                        <Button type="submit" :disabled="form.processing">
                            Create Activity
                        </Button>
                    </div>
                </form>
            </div>

        </div>
    </AppLayout>
</template>
