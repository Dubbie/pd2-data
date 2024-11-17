<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    item: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AppLayout>
        <h1 class="font-display text-3xl font-bold">{{ item.name }}</h1>

        <code>
            <pre>{{ item }}</pre>
        </code>
    </AppLayout>
</template>
