<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    stats: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <AppLayout>
        <h1 class="font-display text-3xl font-bold">Stats</h1>

        <div class="mt-6 space-y-12">
            <div v-for="stat in stats" :key="stat.name" class="text-sm">
                <div class="grid grid-cols-3">
                    <div>
                        <p class="font-display font-bold text-orange-500">
                            {{ stat.name }}
                        </p>
                    </div>

                    <div class="col-span-2">
                        <h3 class="mb-2 font-semibold">Description</h3>
                        <p
                            v-if="!stat.description"
                            class="font-semibold text-zinc-600"
                        >
                            No description
                        </p>
                        <div v-else class="flex gap-x-6">
                            <div>
                                <p>Priority: {{ stat.description.priority }}</p>
                                <p>Function: {{ stat.description.function }}</p>
                                <p>Value: {{ stat.description.value }}</p>
                            </div>
                            <div>
                                <p>Positive: {{ stat.description.positive }}</p>
                                <p>Negative: {{ stat.description.negative }}</p>
                                <p>
                                    Extra:
                                    {{ stat.description.extra ?? 'No data' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
