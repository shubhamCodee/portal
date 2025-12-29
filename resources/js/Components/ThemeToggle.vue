<script setup>
import { Moon, Sun } from "lucide-vue-next";
import { Button } from "@/Components/ui/button";
import { ref, watchEffect } from "vue";

const theme = ref(localStorage.getItem("theme") ?? "dark");

watchEffect(() => {
    document.documentElement.classList.toggle("dark", theme.value === "dark");
    localStorage.setItem("theme", theme.value);
});

function toggle() {
    theme.value = theme.value === "dark" ? "light" : "dark";
}
</script>

<template>
    <Button variant="ghost" size="icon" @click="toggle">
        <Sun v-if="theme === 'dark'" class="h-4 w-4" />
        <Moon v-else class="h-4 w-4" />
    </Button>
</template>
