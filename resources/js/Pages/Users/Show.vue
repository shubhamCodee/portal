<script setup>
import { Link } from '@inertiajs/vue3'
import { Button } from '@/Components/ui/button'
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card'
import { Badge } from '@/Components/ui/badge'
import { route } from 'ziggy-js'
import AppLayout from '../../Layouts/AppLayout.vue'

defineProps({
    user: Object,
})
</script>

<template>
    <AppLayout>
        <div class="max-w-4xl mx-auto space-y-6">

            <!-- HEADER -->
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold">User Details</h1>

                <div class="flex gap-2">
                    <Link :href="route('users.edit', user.id)">
                        <Button variant="outline">Edit</Button>
                    </Link>

                    <Link :href="route('users.index')">
                        <Button variant="ghost">Back</Button>
                    </Link>
                </div>
            </div>

            <!-- USER INFO -->
            <Card>
                <CardHeader>
                    <CardTitle>{{ user.name }}</CardTitle>
                </CardHeader>

                <CardContent class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-muted-foreground">Email</p>
                        <p>{{ user.email }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-muted-foreground">Phone</p>
                        <p>{{ user.phone || '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-muted-foreground">Date of Birth</p>
                        <p>{{ user.date_of_birth || '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-muted-foreground">Gender</p>
                        <p class="capitalize">{{ user.gender || '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-muted-foreground">Role</p>
                        <Badge variant="secondary">{{ user.role }}</Badge>
                    </div>

                    <div>
                        <p class="text-sm text-muted-foreground">Status</p>
                        <Badge :variant="user.is_active ? 'default' : 'destructive'">
                            {{ user.is_active ? 'Active' : 'Inactive' }}
                        </Badge>
                    </div>

                    <div class="col-span-2">
                        <p class="text-sm text-muted-foreground mb-2">Profile Image</p>

                        <img v-if="user.profile_image" :src="`/storage/${user.profile_image}`" alt="Profile Image"
                            class="h-32 w-32 rounded-md object-cover border" />

                        <p v-else>-</p>
                    </div>

                    <div class="col-span-2">
                        <p class="text-sm text-muted-foreground">Bio</p>
                        <p>{{ user.bio || '-' }}</p>
                    </div>
                </CardContent>
            </Card>

            <!-- ✅ ASSIGNED LEADS -->
            <Card>
                <CardHeader>
                    <CardTitle>Assigned Leads</CardTitle>
                </CardHeader>

                <CardContent>
                    <div v-if="user.assigned_leads.length === 0" class="text-sm text-muted-foreground">
                        No leads assigned to this user.
                    </div>

                    <div v-else class="space-y-3">
                        <div v-for="lead in user.assigned_leads" :key="lead.id"
                            class="flex items-center justify-between rounded-md border p-3 hover:bg-muted/40 transition">
                            <div>
                                <p class="font-medium">
                                    {{ lead.name }}
                                </p>
                                <p class="text-xs text-muted-foreground capitalize">
                                    {{ lead.status }}
                                </p>
                            </div>

                            <Link :href="route('leads.show', lead.id)">
                                <Button size="sm" variant="outline">
                                    View
                                </Button>
                            </Link>
                        </div>
                    </div>
                </CardContent>
            </Card>

        </div>
    </AppLayout>
</template>
