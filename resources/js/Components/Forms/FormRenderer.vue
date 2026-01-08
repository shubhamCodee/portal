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

const props = defineProps({
    schema: Array,
    form: Object,
    errors: Object,
})

const handleFileChange = (event, fieldName) => {
    const file = event.target.files?.[0] ?? null
    props.form[fieldName] = file
    props.form.clearErrors(fieldName)
}
</script>

<template>
    <template v-for="field in schema" :key="field.name">
        <div class="space-y-2" :class="field.props?.class ?? 'col-span-1'">
            <!-- LABEL -->
            <label v-if="field.type !== 'checkbox'" class="text-sm font-medium">
                {{ field.label }}
            </label>

            <!-- TEXT / EMAIL / NUMBER / URL -->
            <Input v-if="['text', 'email', 'number', 'url', 'password'].includes(field.type)" v-model="form[field.name]"
                :type="field.type" v-bind="field.props" @input="form.clearErrors(field.name)"
                :class="errors?.[field.name] ? 'border-red-500' : ''" />

            <!-- TEXTAREA -->
            <Textarea v-else-if="field.type === 'textarea'" v-model="form[field.name]" v-bind="field.props"
                @input="form.clearErrors(field.name)" :class="errors?.[field.name] ? 'border-red-500' : ''" />

            <!-- SELECT -->
            <Select v-else-if="field.type === 'select'" v-model="form[field.name]"
                @update:modelValue="form.clearErrors(field.name)">
                <SelectTrigger class="w-full" :class="errors?.[field.name] ? 'border-red-500' : ''">
                    <SelectValue :placeholder="`Select ${field.label}`" />
                </SelectTrigger>

                <SelectContent>
                    <SelectItem v-for="option in field.props?.options || []" :key="option.value" :value="option.value">
                        {{ option.label }}
                    </SelectItem>
                </SelectContent>
            </Select>

            <!-- MULTISELECT -->
            <Select v-else-if="field.type === 'multiselect'" v-model="form[field.name]" multiple
                @update:modelValue="form.clearErrors(field.name)">
                <SelectTrigger class="w-full">
                    <SelectValue placeholder="Select options" />
                </SelectTrigger>

                <SelectContent>
                    <SelectItem v-for="option in field.props?.options || []" :key="option.value" :value="option.value">
                        {{ option.label }}
                    </SelectItem>
                </SelectContent>
            </Select>

            <!-- DATE -->
            <Input v-else-if="field.type === 'date'" type="date" v-model="form[field.name]" v-bind="field.props"
                @input="form.clearErrors(field.name)" />

            <!-- TIME -->
            <Input v-else-if="field.type === 'time'" type="time" v-model="form[field.name]" v-bind="field.props"
                @input="form.clearErrors(field.name)" />

            <!-- DATETIME -->
            <Input v-else-if="field.type === 'datetime'" type="datetime-local" v-model="form[field.name]"
                v-bind="field.props" @input="form.clearErrors(field.name)" />

            <!-- FILE INPUT (NEW) -->
            <Input v-else-if="field.type === 'file'" type="file" v-bind="field.props"
                @change="handleFileChange($event, field.name)" :class="errors?.[field.name] ? 'border-red-500' : ''" />

            <!-- CHECKBOX -->
            <div v-else-if="field.type === 'checkbox'"
                class="flex items-center gap-3 rounded-md border p-3 bg-muted/30">
                <Checkbox v-model="form[field.name]" v-bind="field.props"
                    @update:modelValue="form.clearErrors(field.name)" />
                <p class="text-sm font-medium">
                    {{ field.label }}
                </p>
            </div>

            <!-- ERROR -->
            <p v-if="errors?.[field.name]" class="text-sm text-red-500">
                {{ errors[field.name] }}
            </p>
        </div>
    </template>
</template>
