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

    if (props.modifier.stats.length === 1) {
        const d2stat = props.modifier.stats[0];
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
    } else {
        // Group, use vars here
        Object.keys(props.modifier.vars).forEach((key) => {
            const varPlaceholder = `{{${key}}}`;

            if (template.includes(varPlaceholder)) {
                const minStat = findStatByName(props.modifier.vars[key].min);
                const maxStat = findStatByName(props.modifier.vars[key].max);

                const minReplacement = formatStatRange(
                    minStat.values.min,
                    minStat.values.max,
                );
                const maxReplacement = formatStatRange(
                    maxStat.values.min,
                    maxStat.values.max,
                );

                let replacement = `${minReplacement} to ${maxReplacement}`;
                if (minReplacement === maxReplacement) {
                    replacement = minReplacement;
                }

                template = template.replace(
                    new RegExp(varPlaceholder, 'g'),
                    replacement,
                );
            }
        });
    }

    return template;
});

const formatStatRange = (min, max) => {
    return min === max ? min : `[${min}-${max}]`;
};

const findStatByName = (statName) => {
    return props.modifier.stats.find((d2stat) => d2stat.stat.name === statName);
};
</script>

<template>
    <p>{{ translatedTemplate }}</p>
</template>
