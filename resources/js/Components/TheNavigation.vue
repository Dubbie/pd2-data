<script setup>
import NavLink from '@/Components/NavLink.vue';
import TheButton from '@/Components/TheButton.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="mx-auto max-w-6xl">
        <div class="flex h-20 items-center gap-x-6 border-b border-b-white/10">
            <div>
                <Link
                    :href="route('home')"
                    class="font-display text-xl font-black"
                >
                    <span>Sanctuary</span>
                    <span class="text-orange-500">Forge</span>
                </Link>
            </div>

            <div class="flex-1">
                <NavLink
                    :href="route('home')"
                    :active="route().current('home')"
                >
                    Home
                </NavLink>
                <NavLink
                    :href="route('stat.index')"
                    :active="route().current('stat.*')"
                >
                    Stats
                </NavLink>
            </div>

            <div>
                <TheButton>Login</TheButton>
            </div>
        </div>
    </div>
</template>
