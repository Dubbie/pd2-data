<script setup>
import ModifierLine from '@/Components/ModifierLine.vue';
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

        <div class="flex justify-center">
            <div
                class="whitespace-nowrap bg-black p-4 text-center text-blue-500"
            >
                <ModifierLine
                    v-for="modifier in modifiers"
                    :key="modifier.name"
                    :modifier="modifier"
                />
            </div>
        </div>

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
