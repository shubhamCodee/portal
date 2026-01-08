<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";
import FormRenderer from "@/Components/Forms/FormRenderer.vue";
import { userFormSchema } from "@/Forms/userFormSchema";
import { route } from "ziggy-js";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    phone: "",
    date_of_birth: "",
    gender: "",
    role: "user",
    is_active: true,
    profile_image: null,
    bio: "",
});

const submit = () => {
    form.post(route("users.store"), {
        preserveScroll: true,
        forceFormData: true,
    });
};
</script>

<template>
    <AppLayout>
        <div class="flex flex-col gap-4">
            <!-- HEADER -->
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-semibold">Create User</h1>
            </div>

            <!-- FORM -->
            <div class="rounded-lg border bg-card p-4">
                <form @submit.prevent="submit" class="grid grid-cols-4 gap-4">
                    <FormRenderer :schema="userFormSchema" :form="form" :errors="form.errors" />

                    <div class="col-span-4 flex justify-end pt-2">
                        <Button type="submit" :disabled="form.processing">
                            Create User
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
