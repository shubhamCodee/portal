<script setup>
import { Input } from '@/Components/ui/input'
import { Textarea } from '@/Components/ui/textarea'
import { Checkbox } from '@/Components/ui/checkbox'
import {
    Select,
    SelectTrigger,
    SelectValue,
    SelectContent,
    SelectItem,
} from '@/Components/ui/select'

defineProps({
    schema: Array,
    form: Object,
    errors: Object,
})
</script>

<template>
    <template v-for="field in schema" :key="field.name">
        <div :class="[
            'space-y-2',
            field.fullWidth ? 'col-span-2' : 'col-span-1',
        ]">
            <label class="text-sm font-medium">
                {{ field.label }}
            </label>

            <Input v-if="['text', 'email'].includes(field.type)" v-model="form[field.name]" :type="field.type"
                @input="form.clearErrors(field.name)" :class="errors?.[field.name] ? 'border-red-500' : ''" />

            <Textarea v-else-if="field.type === 'textarea'" v-model="form[field.name]" rows="2"
                @input="form.clearErrors(field.name)" :class="errors?.[field.name] ? 'border-red-500' : ''" />

            <Select v-else-if="field.type === 'select'" v-model="form[field.name]"
                @update:modelValue="form.clearErrors(field.name)">
                <SelectTrigger class="w-full" :class="errors?.[field.name] ? 'border-red-500' : ''">
                    <SelectValue :placeholder="`Select ${field.label}`" />
                </SelectTrigger>

                <SelectContent>
                    <SelectItem v-for="option in field.options" :key="option.value" :value="option.value">
                        {{ option.label }}
                    </SelectItem>
                </SelectContent>
            </Select>

            <Select v-else-if="field.type === 'multiselect'" v-model="form[field.name]" multiple
                @update:modelValue="form.clearErrors(field.name)">
                <SelectTrigger class="w-full">
                    <SelectValue placeholder="Select options" />
                </SelectTrigger>

                <SelectContent>
                    <SelectItem v-for="option in field.options" :key="option.value" :value="option.value">
                        {{ option.label }}
                    </SelectItem>
                </SelectContent>
            </Select>

            <Input v-else-if="field.type === 'date'" type="date" v-model="form[field.name]"
                @input="form.clearErrors(field.name)" />

            <Input v-else-if="field.type === 'time'" type="time" v-model="form[field.name]"
                @input="form.clearErrors(field.name)" />

            <Input v-else-if="field.type === 'datetime'" type="datetime-local" v-model="form[field.name]"
                @input="form.clearErrors(field.name)" />

            <div v-else-if="field.type === 'checkbox'"
                class="col-span-2 flex items-center gap-3 rounded-md border p-3 bg-muted/30">
                <Checkbox v-model="form[field.name]" @update:modelValue="form.clearErrors(field.name)" />
                <div class="text-sm">
                    <p class="font-medium">{{ field.label }}</p>
                </div>
            </div>


            <p v-if="errors?.[field.name]" class="text-sm text-red-500">
                {{ errors[field.name] }}
            </p>
        </div>
    </template>
</template>
