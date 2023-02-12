<template>
    <div class="grid grid-cols-1 flex justify-center mx-3">
        <div class="card w-full bg-base-100 shadow-xl mt-5">
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
                        <Link :href="route('threads.edit', thread.id)" class="btn btn-outline btn-primary btn-sm">
                        Edit</Link>
                        <button @click="deleteTread(thread.id)" class="btn btn-outline btn-error btn-sm">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
    thread: Object,
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