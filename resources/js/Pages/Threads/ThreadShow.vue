<template>
    <authenticated-layout>
        <div class="grid grid-cols-1 flex justify-center mx-3">
            <div class="card w-full bg-base-100 shadow-xl mt-5">
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
        <div class="flex justify-end m-3">
            <textarea v-model="form.body" class="textarea textarea-primary w-2/3 textarea-lg"
                placeholder="Write your comment"></textarea>

            <!-- <InputError :message="form.errors.body" class="mt-2" /> -->
        </div>
        <div class="flex justify-end mx-3">
            <button @click="submit" class="btn btn-outline btn-primary btn-sm">Save</button>
        </div>
        <!-- comments -->
        <div v-for="comment in comments" :key="comment.id">
            <comment-card :comment="comment" />
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CommentCard from "@/Pages/Threads/Partials/CommentCard.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    thread: Object,
    comments: Object,
})

const form = useForm({
    thread_id: props.thread.id,
    body: '',
})

const submit = () => {
    form.post(route('comments.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('body')
        }
    })
}
</script>