<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    item: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div>
        <Link
            class="flex flex-col items-center"
            :href="route('item.base.show', item)"
        >
            <img
                :src="`/img/items/${item.inventory_image}.png`"
                :alt="item.name"
                loading="lazy"
            />

            <p class="mt-1 text-center font-medium">{{ item.name }}</p>
        </Link>
    </div>
</template>
