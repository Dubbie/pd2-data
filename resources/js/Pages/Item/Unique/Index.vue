<script setup>
import UniqueItem from '@/Components/UniqueItem.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';

const loading = ref(false);
const items = ref([]);
const form = useForm({
    query: '',
});

let abortController = null;
const debounceTimeout = ref(null);

const fetchItems = async (query) => {
    if (abortController) {
        abortController.abort();
    }

    abortController = new AbortController();

    loading.value = true;

    try {
        const response = await axios.get(route('api.item.unique.index'), {
            params: { query },
            signal: abortController.signal,
        });
        items.value = response.data;
    } catch (err) {
        if (axios.isCancel(err)) {
            console.log('Request canceled');
        } else {
            console.log('Error while loading unique items!');
            console.log(err);
        }
    } finally {
        loading.value = false;
    }
};

// Watch for changes in the search query and debounce the fetch
watch(
    () => form.query,
    (newQuery) => {
        clearTimeout(debounceTimeout.value);
        debounceTimeout.value = setTimeout(() => {
            fetchItems(newQuery);
        }, 300); // 300ms debounce
    },
);

onMounted(() => {
    fetchItems();
});
</script>

<template>
    <AppLayout>
        <h1 class="font-display text-3xl font-bold">Unique items</h1>

        <transition
            enter-active-class="transition-all ease-out duration-300"
            enter-from-class="opacity-0 translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition-all ease-out duration-100"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
            mode="out-in"
        >
            <div v-if="loading">
                <p>Loading...</p>
            </div>
            <div v-else class="grid grid-cols-6 items-center gap-6">
                <UniqueItem v-for="item in items" :key="item.id" :item="item" />
            </div>
        </transition>
    </AppLayout>
</template>
