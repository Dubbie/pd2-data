<script setup>
defineProps({
    item: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div>
        <div class="flex flex-col items-center">
            <img
                :src="`/img/items/${item.inventory_image}.png`"
                :alt="item.name"
            />

            <p class="mt-1 text-center font-medium">{{ item.name }}</p>
        </div>
    </div>
</template>
