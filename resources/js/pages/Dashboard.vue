<script setup lang="ts">
import { ref, watch } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import _ from 'lodash';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'LOTR APP',
        href: '/dashboard',
    },
];

const listCreationError = ref('');
const listCreationMessage = ref('');
const listName = ref('');
const name = ref('');
const results = ref([]);
const loading = ref(false);
const error = ref<string | null>(null);

// Search function
const searchCharacter = async (query: string) => {
    if (!query) {
        results.value = [];
        return;
    }

    loading.value = true;
    error.value = null;

    try {
        const response = await axios.get(`/search/name/${query}`);
        results.value = response.data;
    } catch (err) {
        error.value = 'Character not found or an error occurred.';
        results.value = [];
    } finally {
        loading.value = false;
    }
};



const createList = async () => {

    try {
        const response = await axios.post('/lists', {
            name: listName.value.trim(),
        });

        listCreationMessage.value = `List "${response.data.name}" created successfully.`;
        listName.value = '';
    } catch (error: any) {
        if (error.response && error.response.data && error.response.data.message) {
            listCreationError.value = error.response.data.message;
        } else {
            listCreationError.value = 'An error occurred while creating the list.';
        }
    }
};

// Debounced search
const debouncedSearch = _.debounce((val: string) => {
    searchCharacter(val);
}, 500);

// Watch input and auto-search
watch(name, (newVal) => {
    debouncedSearch(newVal);
});
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min p-6">

                <!-- Auto Search Input -->
                <label class="block text-lg font-medium text-gray-800 dark:text-white mb-2">
                    Search for a Lord of the Rings Character
                </label>
                <input
                    v-model="name"
                    type="text"
                    placeholder="Type character name..."
                    class="w-full rounded border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-indigo-500 dark:bg-gray-900 dark:text-white"
                />

                <!-- Loading Message -->
                <div v-if="loading" class="mt-4 text-indigo-600">Searching...</div>

                <!-- Error Message -->
                <div v-if="error" class="mt-4 text-red-500">{{ error }}</div>

                <!-- Results Grid -->
                <div v-if="results.length" class="mt-6">
                    <h2 class="mb-4 text-xl font-semibold text-gray-800 dark:text-white">Results:</h2>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        <div
                            v-for="character in results"
                            :key="character.id"
                            class="rounded border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                        >
                            <div class="font-bold text-lg text-gray-900 dark:text-white">{{ character.name }}</div>
                            <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                <p><strong>Race:</strong> {{ character.race || 'Unknown' }}</p>
                                <p><strong>Birth:</strong> {{ character.birth || 'Unknown' }}</p>
                                <p><strong>Death:</strong> {{ character.death || 'Unknown' }}</p>
                            </div>
                            <a
                                :href="character.wikiUrl"
                                target="_blank"
                                class="mt-3 inline-block text-sm text-indigo-600 hover:underline"
                            >
                                View Wiki
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
