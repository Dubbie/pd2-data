<script setup>
import { computed } from 'vue';

const props = defineProps({
    modifier: {
        type: Object,
        required: true,
    },
});

const translatedTemplate = computed(() => {
    // Replace all @stat@ with their min-max values.
    let template = props.modifier.template;

    props.modifier.stats.forEach((d2stat) => {
        const stat = d2stat.stat;
        const statPlaceholder = `@${stat.name}@`;

        if (template.includes(statPlaceholder)) {
            let replacement = `[${d2stat.values.min}-${d2stat.values.max}]`;
            if (d2stat.values.min === d2stat.values.max) {
                replacement = d2stat.values.min;
            }

            template = template.replace(
                new RegExp(statPlaceholder, 'g'),
                replacement,
            );
        }
    });

    return template;
});
</script>

<template>
    <p>{{ translatedTemplate }}</p>
</template>
