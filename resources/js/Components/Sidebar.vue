<template>
    <div
        class="flex flex-col w-full lg:w-64 flex-shrink-0 lg:border-r bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <div class="flex-shrink-0 px-4 lg:px-8 py-4 flex flex-row items-center justify-between">
            <a href="/">
                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>
        <nav class="flex-grow lg:block px-4 pb-4 lg:pb-0 lg:overflow-y-auto z-10">
            <NavLink :href="route('threads.index')" :active="route().current('threads.index')">Threads</NavLink>
        </nav>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavLink from "@/Components/NavLink.vue";
</script>