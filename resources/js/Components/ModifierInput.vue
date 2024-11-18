<script setup>
import { computed } from 'vue';

const modelValue = defineModel();

const { range } = defineProps({
    range: Object,
});

const inputWidth = computed(() => {
    if (!range) {
        return '3ch';
    }

    return `${range.max.length + 2}ch`;
});
</script>

<template>
    <input
        class="rounded border-none bg-black/50 px-0 py-0.5 text-center text-sm font-semibold ring-1 ring-inset ring-white/10"
        :style="{
            minWidth: inputWidth,
            width: inputWidth,
        }"
        v-model="modelValue"
    />
</template>
