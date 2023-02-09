<template>
    <authenticated-layout>
        <!-- modal -->
        <vue-final-modal v-model="showModal">
            <div class="flex justify-center mt-8">
                <div class="card w-96 bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title flex justify-center">New Thread</h2>
                        <input v-model="form.title" type="text" placeholder="Title"
                            class="input input-bordered input-primary w-full max-w-xs" />
                        <textarea v-model="form.body" class="textarea textarea-primary textarea-lg" placeholder="Description"></textarea>
                        <div class="card-actions justify-end">
                            <button @click="handleThread" class="btn btn-outline btn-error btn-sm">Save</button>
                            <button @click="showModal = false" class="btn btn-outline btn-sm">Close</button>

                        </div>
                    </div>
                </div>
            </div>
        </vue-final-modal>
        <div v-if="$page.props.auth.user" class="flex justify-center mt-8">
            <button @click="showModal = true" class="btn btn-outline btn-primary btn-sm">Create New Thread</button>
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity'
import { $vfm, VueFinalModal, ModalsContainer } from 'vue-final-modal'

let showModal = ref(false);

const form = useForm({
    title: "",
    body: "",
});

const handleThread = () => {
    form.post(route('threads.create'), {
        preserveScroll: true,
        onSuccess: () => {
            showModal.value = false;
        },
    });
};
</script>