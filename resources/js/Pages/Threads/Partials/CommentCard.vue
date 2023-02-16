<template>
    <div class="grid grid-cols-1 flex start mx-3">
        <div class="card w-4/5 bg-base-100 shadow-xl">
            <div class="card-body">
                <div>
                    <div class="card-actions justify-start">
                        <h3>{{ comment.body }}</h3>
                    </div>
                    <div class="grid grid-cols-2">
                        <!-- vote component -->
                        <vote-component :model="comment" :voteableModel="'App\\Models\\Comment'"
                            :voteableId="comment.id" />
                        <!-- card -->
                        <div>
                            <div class="card-actions justify-end">
                                <h6><span style="color:blue">by: </span>{{ comment.user.name }}</h6>
                            </div>
                            <div class="card-actions justify-end">
                                <h6>{{ comment.created_at }}</h6>
                            </div>
                            <div v-if="$page.props.auth.user">
                                <div v-if="$page.props.auth.user.id === comment.user.id"
                                    class="card-actions justify-end">
                                    <!-- buttons -->
                                    <button @click="deleteComment(comment.id)"
                                        class="btn btn-outline btn-error btn-sm">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- comment comments -->
    <div class="grid grid-cols-6">
        <div v-for="commentComment in commentComments" :key="commentComment.id" class="flex justify-end col-span-4 m-3">
            <div class="card w-2/3 bg-base-100 shadow-xl">
                <div class="card-body">
                    <div>
                        <div class="card-actions justify-start">
                            <h3>{{ commentComment.body }}</h3>
                        </div>
                        <div class="grid grid-cols-2">
                            <!-- vote component -->
                            <!-- <vote-component :model="commentComment" :voteableModel="'App\\Models\\Comment'"
                                :voteableId="commentComment.id" /> -->
                            <!-- card -->
                            <div>
                                <div class="card-actions justify-end">
                                    <h6><span style="color:blue">by: </span>{{ commentComment.user.name }}</h6>
                                </div>
                                <div class="card-actions justify-end">
                                    <h6>{{ commentComment.created_at }}</h6>
                                </div>
                                <div v-if="$page.props.auth.user">
                                    <div v-if="$page.props.auth.user.id === commentComment.user.id"
                                        class="card-actions justify-end">
                                        <!-- buttons -->
                                        <button @click="deleteComment(commentComment.id)"
                                            class="btn btn-outline btn-error btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="$page.props.auth.user" class="flex justify-start col-span-2 m-3">
            <div class="grid grid-rows-4">
                <div class="flex justify-end row-span-3">
                    <textarea v-model="form.body" class="textarea textarea-primary w-full textarea-lg"
                        placeholder="Write your comment"></textarea>
                </div>
                <div class="flex justify-end row-span-1 m-3">
                    <button @click="addCommentToComment" class="btn btn-outline btn-primary btn-sm">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import VoteComponent from "./VoteComponent.vue";
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import { ref, onMounted } from 'vue';

const props = defineProps({
    comment: Object,
})

let commentComments = ref({});

const form = useForm({
    body: '',
})

const addCommentToComment = async () => {
    await axios.post(route('comments.store', {
        commentableModel: 'App\\Models\\Comment',
        commentableId: props.comment.id,
    }), form)
        .then(getCommentComments())
}

const getCommentComments = async () => {
    await axios.get(route('comments.comments', {
        commentableId: props.comment.id,
    }))
        .then((response) => {
            commentComments.value = response.data
        })
}

onMounted(() => {
    getCommentComments()
})

const deleteComment = async (id) => {
    if (confirm('Are you sure want to delete this Comment?')) {
        await axios.delete(route('comments.destroy', { id }), {
            preserveScroll: true,
        });
    }
}
</script>