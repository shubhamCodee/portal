<script setup>
import { useForm } from '@inertiajs/vue3'
import UserForm from '@/Components/Forms/UserForm.vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import { route } from 'ziggy-js'
import { toast } from 'vue-sonner'

const props = defineProps({
    user: Object
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '',
    password_confirmation: '',
    phone: props.user.phone,
    date_of_birth: props.user.date_of_birth,
    gender: props.user.gender,
    role: props.user.role,
    is_active: Boolean(props.user.is_active),
    profile_image: null,
    bio: props.user.bio,
})

const submit = () => {
    form.put(route('users.update', props.user.id), {
        onSuccess: () => {
            toast.success('User updated successfully')
        },
    })
}

</script>

<template>
    <AppLayout>
        <UserForm :form="form" :isEdit="true" @submit="submit" />
    </AppLayout>
</template>
