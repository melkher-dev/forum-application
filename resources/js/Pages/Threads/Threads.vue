<template>
    <authenticated-layout>
        <div v-if="$page.props.auth.user" class="flex justify-center mt-5">
            <Link :href="route('threads.create')" class="btn btn-outline btn-primary btn-sm">Create New Thread</Link>
        </div>
        <div v-for="thread in threads" :key="thread.id">
            <thread-card :thread="thread" />
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";
import ThreadCard from "@/Pages/Threads/Partials/ThreadCard.vue";

const props = defineProps({
    threads: Object,
})
</script>