<template>
    <authenticated-layout>
        <div class="flex justify-center mt-5">
            <div class="card w-2/3 bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title flex justify-center">Update Thread</h2>
                    <input v-model="form.title" type="text" placeholder="Title"
                        class="input input-bordered input-primary w-full" />
                    <textarea v-model="form.body" class="textarea textarea-primary textarea-lg"
                        placeholder="Description"></textarea>
                    <div class="card-actions justify-end">
                        <button @click="updateThread" class="btn btn-outline btn-primary btn-sm">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { onMounted } from "@vue/runtime-core";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    thread: Object,
});

const form = useForm({
    // id: props.thread.id,
    title: props.thread.title,
    body: props.thread.body,
});

// onMounted(() => {
//     if (props.thread) {
//         // form.id = props.thread.id;
//         form.title = props.thread.title;
//         form.body = props.thread.body;
//     }
// })

const updateThread = () => {
    form.put(route('threads.update', props.thread.id), {
        preserveScroll: true,
    });
}
</script>