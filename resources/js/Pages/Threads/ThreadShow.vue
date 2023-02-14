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
                        <div class="grid grid-cols-2">
                            <div v-if="$page.props.auth.user" class="flex justify-start mt-2">
                                <!-- <div v-if="$page.props.auth.user.id != comment.user.id" class="card-actions justify-end"> -->
                                <!-- buttons -->
                                <!-- <h6 class="mt-1">Vote: </h6> -->
                                <button @click="downVote(thread.id)" class="btn btn-outline btn-error btn-sm">
                                    <svg class="h-8 w-8 text-red-500" width="24" height="24" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="18" y1="13" x2="12" y2="19" />
                                        <line x1="6" y1="13" x2="12" y2="19" />
                                    </svg>
                                </button>
                                <h6 class="mt-1 mx-2">{{ threadVoteResult }}</h6>
                                <button @click="upVote(thread.id)" class="btn btn-outline btn-primary btn-sm">
                                    <svg class="h-8 w-8 text-blue-500" width="24" height="24" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="18" y1="11" x2="12" y2="5" />
                                        <line x1="6" y1="11" x2="12" y2="5" />
                                    </svg>
                                </button>
                                <!-- </div> -->
                            </div>
                            <div class="flex justify-end mt-2">
                                <h6><span style="color:blue">author: </span>{{ thread.user.name }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- comment input -->
        <div v-if="$page.props.auth.user">
            <div class="flex justify-end m-3">
                <textarea v-model="form.body" class="textarea textarea-primary w-96 textarea-lg"
                    placeholder="Write your comment"></textarea>

                <!-- <InputError :message="form.errors.body" class="mt-2" /> -->
            </div>
            <div class="flex justify-end mx-3">
                <button @click="submit" class="btn btn-outline btn-primary btn-sm">Save</button>
            </div>
        </div>
        <!-- comments -->
        <div v-for="comment in comments" :key="comment.id">
            <comment-card :comment="comment" :commentVoteResult="commentVoteResult" />
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CommentCard from "@/Pages/Threads/Partials/CommentCard.vue";
import { useForm, router } from "@inertiajs/vue3";
import { isIntegerKey } from "@vue/shared";

const props = defineProps({
    thread: Object,
    comments: Object,
    commentVoteResult: Number,
    threadVoteResult: Number,
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

const upVote = (id) => {
    router.post(route('votes.upvote.thread', id), {
        preserveScroll: true,
    });
}

const downVote = (id) => {
    router.post(route('votes.downvote.thread', id), {
        preserveScroll: true,
    });
}
</script>