<template>
    <div>
        <nav class="
                                  bg-white
                                  dark:bg-gray-800
                                  border-b border-gray-100
                                  dark:border-gray-700
                                ">
            <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex mt-4">
                        <input v-model="form.search" type="text" placeholder="Search Threads"
                            class="input input-bordered input-primary input-sm w-full max-w-xs" />
                        <button @click="searchThreads" class="btn btn-outline btn-primary btn-sm ml-2">Search</button>
                    </div>

                    <div v-if="$page.props.auth.user" class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="
                                                  inline-flex
                                                  items-center
                                                  px-3
                                                  py-2
                                                  border border-transparent
                                                  text-sm
                                                  leading-4
                                                  font-medium
                                                  rounded-md
                                                  text-gray-500
                                                  bg-white
                                                  dark:bg-gray-800
                                                  hover:text-gray-700
                                                  dark:hover:text-gray-300
                                                  focus:outline-none
                                                  transition
                                                  ease-in-out
                                                  duration-150
                                                ">
                                            {{ $page.props.auth.user.name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">
                                        Profile
                                    </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                    <div v-else class="mt-5">
                        <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">
                        Log in</Link>

                        <Link :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">
                        Register</Link>
                    </div>
                </div>
            </div>
        </nav>
</div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
// import { ref } from '@vue/reactivity';
import axios from 'axios';

// const search = ref('');

const form = useForm({
    search: ''
});

const searchThreads = () => {
    form.post(route('threads.search'), {
        preserveScroll: true
    });
}
// const searchThreads = () => {
//     axios.post(route('threads.search'), {
//         search: search.value
//     }).then(window.location = "/threads/search");
// }
</script>