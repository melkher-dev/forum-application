<template>
    <div class="grid grid-cols-1 flex justify-center mx-3">
        <div class="card w-2/3 bg-base-100 shadow-xl mt-5">
            <div class="card-body">
                <div>
                    <div class="card-actions justify-start">
                        <h3>{{ comment.body }}</h3>
                    </div>
                    <div class="grid grid-cols-2">
                        <div v-if="$page.props.auth.user" class="flex justify-start mt-5">
                            <!-- <div v-if="$page.props.auth.user.id != comment.user.id" class="card-actions justify-end"> -->
                            <!-- buttons -->
                            <!-- <h6 class="mt-1">Vote: </h6> -->
                            <button @click="vote('downvote')" class="btn btn-error btn-sm mx-1" :class="{
                                'btn-outline': vote.type === 'downvote',
                            }">
                                <svg class="h-8 w-8 text-red-500" width="24" height="24" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="18" y1="13" x2="12" y2="19" />
                                    <line x1="6" y1="13" x2="12" y2="19" />
                                </svg>
                            </button>
                            <h6 class="mt-1 mx-2">{{ voteResult }}</h6>
                            <button @click="vote('upvote')" class="btn btn-primary btn-sm mx-1" :class="{
                                'btn-outline': vote.type === 'upvote',
                            }">
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
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { onMounted, ref } from 'vue';
import axios from "axios";


const props = defineProps({
    comment: Object,
})

let voteResult = ref();

const deleteComment = (id) => {
    if (confirm('Are you sure want to delete this Comment?')) {
        router.delete(route('comments.destroy', id), {
            preserveScroll: true,
        });
    }
}

const vote = (type) => {
    router.post(route('votes.store', { voteableModel: 'App\\Models\\Comment', voteableType: type, voteableId: props.comment.id }), {
        preserveScroll: true,
    }).then(() => {
        if (type === 'upvote') {
            voteResult.value = voteResult.value + 1;
        } else {
            voteResult.value = voteResult.value - 1;
        }
    });
}

const getVotes = () => {
    axios.get(route('get.votes', { voteableId: props.comment.id }))
        .then((res) => {
            voteResult.value = res.data;
        });
}

onMounted(() => {
    getVotes();
})
</script>