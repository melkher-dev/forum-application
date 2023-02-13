<template>
    <authenticated-layout>
        <div class="flex justify-center mt-5">
            <div class="card w-2/3 bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title flex justify-center">Update Thread</h2>
                    <input v-model="form.title" type="text" placeholder="Title"
                        class="input input-bordered input-primary w-full" />

                    <InputError :message="form.errors.title" class="mt-2" />

                    <textarea v-model="form.body" class="textarea textarea-primary textarea-lg"
                        placeholder="Description"></textarea>

                    <InputError :message="form.errors.body" class="mt-2" />

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
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    thread: Object,
});

const form = useForm({
    title: props.thread.title,
    body: props.thread.body,
});

const updateThread = () => {
    form.put(route('threads.update', props.thread.id), {
        preserveScroll: true,
    });
}
</script>