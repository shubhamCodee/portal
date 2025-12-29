<script setup>
import { Link } from "@inertiajs/vue3";
import ThemeToggle from "@/Components/ThemeToggle.vue";
import { Toaster } from '@/Components/ui/sonner'
import { toast } from 'vue-sonner'
import 'vue-sonner/style.css'
import { usePage } from '@inertiajs/vue3'
import { watch } from 'vue'

const page = usePage()

watch(
    () => page.props,
    (props) => {
        if (props.flash?.success) {
            toast.success(props.flash.success)
        }
    },
    { deep: true }
)
</script>

<template>
    <div class="min-h-screen bg-background text-foreground">
        <header class="border-b">
            <div class="flex h-14 items-center justify-between px-6">
                <div class="flex items-center gap-6">
                    <Link href="/" class="font-semibold hover:opacity-80 transition">
                        logo
                    </Link>

                    <Link href="/users" class="text-sm text-muted-foreground hover:text-foreground transition">
                        users
                    </Link>
                </div>

                <ThemeToggle />
            </div>
        </header>

        <main class="p-6">
            <Toaster position="top-center" />
            <slot />
        </main>
    </div>
</template>
