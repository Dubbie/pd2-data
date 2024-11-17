<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    color: {
        type: String,
        default: 'zinc',
    },
    type: {
        type: String,
        default: 'button',
    },
    size: {
        type: String,
        default: 'md',
    },
    variant: {
        type: String,
        default: 'default',
    },
    href: String,
});

const colorMap = {
    default: {
        zinc: 'bg-zinc-700 text-white',
    },
};

const colorClasses = computed(() => {
    return colorMap[props.variant][props.color] ?? '';
});

const sizeClasses = computed(() => {
    return {
        md: 'text-sm font-medium px-6 py-2',
    }[props.size];
});
</script>

<template>
    <component
        :is="href ? Link : 'button'"
        :href="href"
        class="rounded-full"
        :class="[colorClasses, sizeClasses]"
    >
        <slot />
    </component>
</template>
