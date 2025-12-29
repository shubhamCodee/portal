<script setup>
import { useForm } from '@inertiajs/vue3'
import UserForm from '@/Components/Forms/UserForm.vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import { route } from 'ziggy-js'
import { toast } from 'vue-sonner'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    phone: '',
    date_of_birth: '',
    gender: '',
    role: '',
    is_active: false,
    profile_image: null,
    bio: '',
})

const submit = () => {
    form.post(route('users.store'), {
        onSuccess: () => {
            toast.success('User created successfully')
        },
    })
}

</script>

<template>
    <AppLayout>
        <UserForm :form="form" :isEdit="false" @submit="submit" />
    </AppLayout>
</template>
