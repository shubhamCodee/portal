<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { Button } from '@/Components/ui/button'
import FormRenderer from '@/Components/Forms/FormRenderer.vue'
import { activityFormSchema } from '@/Forms/activityFormSchema'
import { route } from 'ziggy-js'

const props = defineProps({
    lead: Object,
    activity: Object,
    users: Array,
})

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
    assigned_to_user_id: props.activity.assigned_to_user_id ?? '',
    subject: props.activity.subject ?? '',
    type: props.activity.type ?? '',
    status: props.activity.status ?? '',
    scheduled_at: props.activity.scheduled_at ?? '',
    duration_minutes: props.activity.duration_minutes ?? '',
    description: props.activity.description ?? '',
})

const submit = () => {
    form.put(
        route('leads.activities.update', [props.lead.id, props.activity.id]),
        { preserveScroll: true }
    )
}
</script>

<template>
    <AppLayout>
        <div class="flex flex-col gap-4 max-w-4xl mx-auto">

            <!-- HEADER -->
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-semibold">
                    Edit Activity for {{ lead.name }}
                </h1>
            </div>

            <!-- FORM -->
            <div class="rounded-lg border bg-card p-4">
                <form @submit.prevent="submit" class="grid grid-cols-2 gap-4">
                    <FormRenderer :schema="schema" :form="form" :errors="form.errors" />

                    <div class="col-span-2 flex justify-end pt-2 gap-2">
                        <Button type="submit" :disabled="form.processing">
                            Update Activity
                        </Button>
                    </div>
                </form>
            </div>

        </div>
    </AppLayout>
</template>
