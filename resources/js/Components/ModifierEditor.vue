<script setup>
import { onMounted, ref } from 'vue';
import ModifierInput from './ModifierInput.vue';

const { modifier } = defineProps({
    modifier: {
        type: Object,
        required: true,
    },
});

const exactValue = ref(null);

const splitTemplate = () => {
    const parts = modifier.template.split(/(@\w*@)/g);
    return parts.filter((part) => part !== ''); // Remove empty parts;
};

const isPlaceholder = (part) => {
    return part.includes('@');
};

const getRangeByPlaceholder = (placeholder) => {
    const statName = placeholder.replaceAll('@', '');
    const d2stat = findStatByName(statName);

    return {
        min: d2stat.values.min,
        max: d2stat.values.max,
    };
};

const findStatByName = (statName) => {
    return modifier.stats.find((d2stat) => d2stat.stat.name === statName);
};

const parts = splitTemplate();

onMounted(() => {
    if (modifier.stats[0].values.max) {
        exactValue.value = modifier.stats[0].values.max;
    }
});
</script>

<template>
    <div class="flex items-center gap-x-1">
        <template v-for="(part, index) in parts" :key="index">
            <p v-if="!isPlaceholder(part)" class="font-semibold">{{ part }}</p>
            <ModifierInput
                v-else
                v-model="exactValue"
                :range="getRangeByPlaceholder(part)"
            />
        </template>
    </div>
</template>
