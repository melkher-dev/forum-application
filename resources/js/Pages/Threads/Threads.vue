<template>
    <authenticated-layout>
        <!-- modal -->
        <vue-final-modal v-model="showModal">
            <div class="flex justify-center mt-5">
                <div class="card w-2/3 bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title flex justify-center">New Thread</h2>
                        <input v-model="form.title" type="text" placeholder="Title"
                            class="input input-bordered input-primary w-full" />
                        <textarea v-model="form.body" class="textarea textarea-primary textarea-lg"
                            placeholder="Description"></textarea>
                        <div class="card-actions justify-end">
                            <button @click="handleThread" class="btn btn-outline btn-primary btn-sm">Save</button>
                            <button @click="showModal = false" class="btn btn-outline btn-sm">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </vue-final-modal>
        <div v-if="$page.props.auth.user" class="flex justify-center mt-5">
            <button @click="showModal = true" class="btn btn-outline btn-primary btn-sm">Create New Thread</button>
        </div>
        <div class="grid grid-cols-1 flex justify-center mx-3">
            <div v-for="thread in threads" :key="thread.id" class="card w-full bg-base-100 shadow-xl mt-5">
                <div class="card-body">
                    <div>
                        <h2 class="card-title"><span style="color:blue">title: </span><span style="color:aquamarine">{{
                            thread.title
                        }}</span></h2>
                        <h3><span style="color:blue">description: </span><span style="color:aquamarine">{{
                            thread.body
                        }}</span></h3>
                        <h6><span style="color:gold">author: </span> <span style="color:aquamarine">{{
                            thread.user.name
                        }}</span></h6>
                    </div>
                    <div v-if="$page.props.auth.user">
                        <div v-if="$page.props.auth.user.id === thread.user.id" class="card-actions justify-end">
                            <!-- delete button -->
                            <svg @click="deleteTread(thread.id)" class="h-8 w-8 text-red-500 mx-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
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
import { $vfm, VueFinalModal, ModalsContainer } from 'vue-final-modal';
import { router } from "@inertiajs/vue3";


const props = defineProps({
    threads: Object,
})
let showModal = ref(false);

const form = useForm({
    title: "",
    body: "",
});

const handleThread = () => {
    form.post(route('threads.store'), {
        preserveScroll: true,
        onSuccess: () => {
            showModal.value = false;
            form.reset('title', 'body');
        },
    });
};

const deleteTread = (id) => {
    if (confirm('Are you sure want to delete this Thread?')) {
        router.delete(route('threads.destroy', id), {
            preserveScroll: true,
            onSuccess: () => {
                window.location.reload();
            }
        });
    }
}
</script>