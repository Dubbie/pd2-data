<script setup>
import { onMounted, ref } from 'vue';
import ModifierInput from './ModifierInput.vue';

const { modifier } = defineProps({
    modifier: {
        type: Object,
        required: true,
    },
});

// Reactive reference for exact value
const exactValue = ref(null);

/**
 * Splits the template into parts: placeholders and static text.
 * Example: "+@item_mindamage_percent@% Enhanced Damage" -> ["+", "@item_mindamage_percent@", "% Enhanced Damage"]
 */
const splitTemplate = () =>
    modifier.template.split(/(@\w*@)/g).filter((part) => part !== '');

/**
 * Checks if a part is a placeholder (e.g., "@stat_name@").
 */
const isPlaceholder = (part) => part.startsWith('@') && part.endsWith('@');

/**
 * Finds the stat in the modifier by its name and returns its range.
 * Adds a check for fixed ranges where min and max are the same.
 * @param {string} placeholder - The placeholder string (e.g., "@stat_name@").
 * @returns {{ min: string, max: string, isFixed: boolean }} - The range object for the stat.
 */
const getRangeByPlaceholder = (placeholder) => {
    const statName = placeholder.replaceAll('@', '');
    const d2stat = findStatByName(statName);

    if (!d2stat) {
        console.warn(`Stat "${statName}" not found in modifier.`);
        return { min: '0', max: '0', isFixed: true }; // Default fallback range
    }

    const { min, max } = d2stat.values;
    return { min, max, isFixed: min === max };
};

/**
 * Finds a stat by its name within the modifier stats array.
 * @param {string} statName - The name of the stat to find.
 * @returns {Object} - The stat object if found.
 */
const findStatByName = (statName) =>
    modifier.stats.find((d2stat) => d2stat.stat.name === statName);

// Split the template into parts (placeholders and static text)
const parts = splitTemplate();

// Set the default exact value to the max value of the first stat on mount
onMounted(() => {
    const firstStat = modifier.stats[0]?.values;
    if (firstStat?.max) {
        exactValue.value = firstStat.max;
    }
});
</script>

<template>
    <div class="flex items-center gap-x-1">
        <template v-for="(part, index) in parts" :key="index">
            <!-- Render static text -->
            <p v-if="!isPlaceholder(part)" class="font-semibold">{{ part }}</p>

            <!-- Check if range is fixed -->
            <template v-else>
                <p
                    v-if="getRangeByPlaceholder(part).isFixed"
                    class="font-semibold"
                >
                    {{ getRangeByPlaceholder(part).min }}
                </p>
                <ModifierInput
                    v-else
                    v-model="exactValue"
                    :range="getRangeByPlaceholder(part)"
                />
            </template>
        </template>
    </div>
</template>
