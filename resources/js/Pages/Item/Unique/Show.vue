<script setup>
import ModifierEditor from '@/Components/ModifierEditor.vue';
import ModifierLine from '@/Components/ModifierLine.vue';
import TheButton from '@/Components/TheButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';

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

const showingDebug = ref(false);
</script>

<template>
    <AppLayout>
        <h1 class="mb-12 font-display text-3xl font-bold">{{ item.name }}</h1>

        <div class="grid grid-cols-2 items-start gap-x-12">
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

            <div>
                <p class="mb-3 font-display text-2xl font-bold text-unique">
                    Unique properties
                </p>

                <div class="space-y-1">
                    <ModifierEditor
                        v-for="modifier in modifiers"
                        :key="modifier.name"
                        :modifier="modifier"
                    />
                </div>
            </div>
        </div>

        <div class="mt-6">
            <TheButton class="mb-3" @click="showingDebug = !showingDebug"
                >Debug</TheButton
            >
            <div class="text-xs" v-show="showingDebug">
                <p class="text-sm font-semibold">Modifiers:</p>
                <code>
                    <pre>{{ modifiers }}</pre>
                </code>

                <p class="text-sm font-semibold">Item:</p>
                <code>
                    <pre>{{ item }}</pre>
                </code>
            </div>
        </div>
    </AppLayout>
</template>
