<script setup>
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Button } from "@/Components/ui/button";
import { Pencil, Plus, Trash2 } from "lucide-vue-next";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table";
import { route } from "ziggy-js";

defineProps({ users: Array });

const goToShow = (id) => {
    router.visit(route("users.show", id));
};
</script>

<template>
    <AppLayout>
        <div class="rounded-lg border bg-card p-4">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-lg font-semibold">Users</h1>

                <Link :href="route('users.create')">
                    <Button>
                        <Plus class="h-4 w-4 mr-2" />
                        Create User
                    </Button>
                </Link>
            </div>

            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Name</TableHead>
                        <TableHead>Email</TableHead>
                        <TableHead>Role</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead class="text-right">Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-if="users.length === 0">
                        <TableCell colspan="5" class="text-center py-12 text-muted-foreground">
                            <div class="flex flex-col items-center gap-3">
                                <p class="text-sm">No users found</p>

                                <Link :href="route('users.create')">
                                    <Button variant="outline" size="sm">
                                        <Plus class="h-4 w-4 mr-2" />
                                        Create your first user
                                    </Button>
                                </Link>
                            </div>
                        </TableCell>
                    </TableRow>

                    <TableRow v-else v-for="user in users" :key="user.id" class="cursor-pointer hover:bg-muted/50"
                        @click="goToShow(user.id)">
                        <TableCell class="font-medium">
                            {{ user.name }}
                        </TableCell>

                        <TableCell>
                            {{ user.email }}
                        </TableCell>

                        <TableCell class="capitalize">
                            {{ user.role }}
                        </TableCell>

                        <TableCell>
                            <span class="text-xs font-medium px-2 py-1 rounded" :class="user.is_active
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700'">
                                {{ user.is_active ? "Active" : "Inactive" }}
                            </span>
                        </TableCell>

                        <TableCell class="text-right flex justify-end gap-2">
                            <Link :href="route('users.edit', user.id)" @click.stop>
                                <Button variant="outline" size="icon">
                                    <Pencil class="h-4 w-4" />
                                </Button>
                            </Link>

                            <Link :href="route('users.destroy', user.id)" method="delete" as="button" preserve-scroll
                                @click.stop>
                                <Button variant="destructive" size="icon" type="button">
                                    <Trash2 class="h-4 w-4" />
                                </Button>
                            </Link>
                        </TableCell>
                    </TableRow>
                </TableBody>

            </Table>
        </div>
    </AppLayout>
</template>
