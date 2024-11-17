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
            :href="route('item.unique.show', item)"
        >
            <img
                :src="`/img/items/${item.inventory_image}.png`"
                :alt="item.name"
                loading="lazy"
            />

            <div class="mt-1 text-center font-medium text-unique">
                <p>{{ item.name }}</p>
                <p>{{ item.base_item.name }}</p>
            </div>
        </Link>
    </div>
</template>
