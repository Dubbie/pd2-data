<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    item: {
        type: Object,
        required: true,
    },
    modifiers: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <AppLayout>
        <h1 class="font-display text-3xl font-bold">{{ item.name }}</h1>

        <p>Modifiers:</p>
        <code>
            <pre>{{ modifiers }}</pre>
        </code>

        <p>Item:</p>
        <code>
            <pre>{{ item }}</pre>
        </code>
    </AppLayout>
</template>
