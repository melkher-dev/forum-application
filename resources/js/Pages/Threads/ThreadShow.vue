<template>
    <authenticated-layout>
        <div class="grid grid-cols-1 flex justify-center mx-3">
            <div :href="route('threads.show', thread.id)" class="card w-full bg-base-100 shadow-xl mt-5">
                <div class="card-body">
                    <div>
                        <div class="card-actions justify-center">
                            <h2 class="card-title">{{ thread.title }}</h2>
                        </div>
                        <div class="card-actions justify-center">
                            <h3>{{ thread.body }}</h3>
                        </div>
                        <div class="card-actions justify-end">
                            <h6><span style="color:blue">author: </span>{{ thread.user.name }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    thread: Object,
})
</script>