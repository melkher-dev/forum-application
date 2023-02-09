<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Sidebar from '@/Components/Sidebar.vue';
const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="lg:flex flex-col lg:flex-row lg:min-h-screen w-full">
                <!-- Sidebar -->
                <Sidebar />

                <!-- Navbar -->
                <div class="w-full">
                    <Navbar />

                    <main>
                        <slot />
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>
