<script setup>
import TheNavigation from '@/Components/TheNavigation.vue';
</script>

<template>
    <div class="min-h-svh bg-zinc-900 text-white">
        <TheNavigation />

        <div class="mx-auto max-w-6xl py-6">
            <slot />
        </div>
    </div>
</template>
