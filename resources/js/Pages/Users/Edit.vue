<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";
import FormRenderer from "@/Components/Forms/FormRenderer.vue";
import { userFormSchema } from "@/Forms/userFormSchema";
import { route } from "ziggy-js";

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name ?? "",
    email: props.user.email ?? "",
    phone: props.user.phone ?? "",
    date_of_birth: props.user.date_of_birth ?? "",
    gender: props.user.gender ?? "",
    role: props.user.role ?? "user",
    is_active: props.user.is_active ? true : false,
    bio: props.user.bio ?? "",
    profile_image: null,
});

const submit = () => {
    form.put(route("users.update", props.user.id), {
        preserveScroll: true,
        forceFormData: true,
    });
};
</script>

<template>
    <AppLayout>
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-semibold">Edit User</h1>
            </div>

            <div class="rounded-lg border bg-card p-4">
                <form @submit.prevent="submit" class="grid grid-cols-4 gap-4">
                    <FormRenderer :schema="userFormSchema" :form="form" :errors="form.errors" />

                    <div class="col-span-4 flex justify-end pt-2">
                        <Button type="submit" :disabled="form.processing">
                            Update User
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
