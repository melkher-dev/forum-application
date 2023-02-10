<template>
    <authenticated-layout>
        <div v-if="$page.props.auth.user" class="flex justify-center mt-5">
            <Link :href="route('threads.create')" class="btn btn-outline btn-primary btn-sm">Create New Thread</Link>
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
                            <button @click="deleteTread(thread.id)"
                                class="btn btn-outline btn-error btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";


const props = defineProps({
    threads: Object,
})

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