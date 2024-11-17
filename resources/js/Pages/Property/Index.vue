<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    properties: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <AppLayout>
        <h1 class="font-display text-3xl font-bold">Properties</h1>

        <div class="mt-6 space-y-12">
            <div
                v-for="property in properties"
                :key="property.code"
                class="text-sm"
            >
                <p class="font-display font-bold text-orange-500">
                    {{ property.code }}
                </p>

                <div
                    v-if="property.property_stats.length > 0"
                    class="flex items-start gap-x-6"
                >
                    <div
                        v-for="pStat in property.property_stats"
                        :key="pStat.id"
                    >
                        <p class="font-semibold">
                            {{ pStat.stat_name ?? 'Unknown stat' }}
                        </p>

                        <div class="mt-1 text-xs font-medium">
                            <p>Set: {{ pStat.set_stat ?? 'None' }}</p>
                            <p>Val: {{ pStat.value ?? 'None' }}</p>
                            <p>Func: {{ pStat.function }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
