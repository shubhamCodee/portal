<script setup>
import { ref } from 'vue'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { Button } from '@/Components/ui/button'
import { Textarea } from '@/Components/ui/textarea'
import {
    Select,
    SelectItem,
    SelectTrigger,
    SelectContent,
} from '@/Components/ui/select'
import { Checkbox } from '@/Components/ui/checkbox'

const props = defineProps({
    form: Object,
    isEdit: Boolean,
})

defineEmits(['submit'])

const imagePreview = ref(null)

const handleImageChange = (e) => {
    const file = e.target.files[0]

    if (!file) return

    props.form.profile_image = file
    props.form.clearErrors('profile_image')

    imagePreview.value = URL.createObjectURL(file)
}
</script>

<template>
    <form @submit.prevent="$emit('submit')" class="grid grid-cols-2 gap-6 w-full">

        <div class="space-y-2">
            <Label>Name</Label>
            <Input v-model="form.name" type="text" @input="form.clearErrors('name')"
                :class="form.errors.name ? 'border-red-500' : ''" />
            <p v-if="form.errors.name" class="text-sm text-red-500">
                {{ form.errors.name }}
            </p>
        </div>

        <div class="space-y-2">
            <Label>Email</Label>
            <Input v-model="form.email" type="email" @input="form.clearErrors('email')"
                :class="form.errors.email ? 'border-red-500' : ''" />
            <p v-if="form.errors.email" class="text-sm text-red-500">
                {{ form.errors.email }}
            </p>
        </div>

        <div class="space-y-2">
            <Label>Password</Label>
            <Input v-model="form.password" type="password" @input="form.clearErrors('password')"
                :class="form.errors.password ? 'border-red-500' : ''" />
            <p v-if="form.errors.password" class="text-sm text-red-500">
                {{ form.errors.password }}
            </p>
        </div>

        <div class="space-y-2">
            <Label>Confirm Password</Label>
            <Input v-model="form.password_confirmation" type="password"
                @input="form.clearErrors('password_confirmation')" />
        </div>

        <div class="space-y-2">
            <Label>Phone</Label>
            <Input v-model="form.phone" type="number" @input="form.clearErrors('phone')"
                :class="form.errors.phone ? 'border-red-500' : ''" />
            <p v-if="form.errors.phone" class="text-sm text-red-500">
                {{ form.errors.phone }}
            </p>
        </div>

        <div class="space-y-2">
            <Label>Date of Birth</Label>
            <Input v-model="form.date_of_birth" type="date" @input="form.clearErrors('date_of_birth')"
                :class="form.errors.date_of_birth ? 'border-red-500' : ''" />
            <p v-if="form.errors.date_of_birth" class="text-sm text-red-500">
                {{ form.errors.date_of_birth }}
            </p>
        </div>

        <div class="space-y-2">
            <Label>Gender</Label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2">
                    <input type="radio" value="male" v-model="form.gender" @change="form.clearErrors('gender')" />
                    Male
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" value="female" v-model="form.gender" @change="form.clearErrors('gender')" />
                    Female
                </label>
            </div>
            <p v-if="form.errors.gender" class="text-sm text-red-500">
                {{ form.errors.gender }}
            </p>
        </div>

        <div class="space-y-2">
            <Label>Role</Label>
            <Select v-model="form.role" @update:modelValue="form.clearErrors('role')">
                <SelectTrigger :class="form.errors.role ? 'border-red-500' : ''">
                    <span>
                        {{ form.role || 'Select role' }}
                    </span>
                </SelectTrigger>

                <SelectContent>
                    <SelectItem value="admin">Admin</SelectItem>
                    <SelectItem value="user">User</SelectItem>
                </SelectContent>
            </Select>

            <p v-if="form.errors.role" class="text-sm text-red-500">
                {{ form.errors.role }}
            </p>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <Checkbox v-model="form.is_active" @update:modelValue="form.clearErrors('is_active')" />
            <Label>Active</Label>
        </div>

        <div class="space-y-2">
            <Label>Profile Image</Label>
            <Input type="file" accept="image/*" @change="handleImageChange"
                :class="form.errors.profile_image ? 'border-red-500' : ''" />
            <p v-if="form.errors.profile_image" class="text-sm text-red-500">
                {{ form.errors.profile_image }}
            </p>

            <img v-if="imagePreview" :src="imagePreview" class="h-24 w-24 rounded-md object-cover border mt-2" />
        </div>

        <div class="col-span-2 space-y-2">
            <Label>Bio</Label>
            <Textarea v-model="form.bio" rows="3" @input="form.clearErrors('bio')"
                :class="form.errors.bio ? 'border-red-500' : ''" />
            <p v-if="form.errors.bio" class="text-sm text-red-500">
                {{ form.errors.bio }}
            </p>
        </div>

        <div class="col-span-2 flex justify-end">
            <Button type="submit" :disabled="form.processing">
                {{ isEdit ? 'Update User' : 'Create User' }}
            </Button>
        </div>

    </form>
</template>
