<template>
    <div class="grid grid-cols-1 flex justify-center mx-3">
        <Link :href="route('threads.show', thread.id)" class="card w-full bg-base-100 shadow-xl mt-5">
        <div class="card-body">
            <div>
                <div>
                    <div class="card-actions justify-center">
                        <h2 class="card-title">{{ thread.title }}</h2>
                    </div>
                    <div class="card-actions start">
                        <h3>{{ thread.body }}</h3>
                    </div>
                    <div class="card-actions justify-end">
                        <h6><span style="color:blue">author: </span>{{ thread.user.name }}</h6>
                    </div>
                    <div class="card-actions justify-end">
                        <h6>{{ thread.created_at }}</h6>
                    </div>
                </div>
            </div>
            <div v-if="$page.props.auth.user">
                <div v-if="$page.props.auth.user.id === thread.user.id" class="card-actions justify-end">
                    <!-- buttons -->
                    <Link :href="route('threads.edit', thread.id)" class="btn btn-outline btn-primary btn-sm">
                    Edit</Link>
                    <button @click="deleteTread(thread.id)" class="btn btn-outline btn-error btn-sm">Delete</button>
                </div>
            </div>
        </div>
        </Link>
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