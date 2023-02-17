<template>
    <authenticated-layout>
        <div class="flex justify-center m-3">
            <Link :href="route('threads.show', thread.id)" v-for="thread in threads" :key="thread.id"
                class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Search Results</h2>
                <p>{{ thread.title }}</p>
                <p>{{ thread.body }}</p>
            </div>
            </Link>
        </div>
</authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    threads: Object,
});
</script>