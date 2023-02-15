<template>
    <div v-if="$page.props.auth.user" class="flex justify-start mt-5">
        <!-- <div v-if="$page.props.auth.user.id != comment.user.id" class="card-actions justify-end"> -->
        <!-- buttons -->
        <!-- <h6 class="mt-1">Vote: </h6> -->
        <button @click="vote('downvote')" class="btn btn-error btn-outline btn-sm mx-1" :class="{
            'btn-active': voteStatus === 'downvote',
        }">-</button>
        <h6 class="mt-1 mx-2">{{ voteResult }}</h6>
        <button @click="vote('upvote')" class="btn btn-primary btn-outline btn-sm mx-1" :class="{
            'btn-active': voteStatus === 'upvote',
        }">+</button>
        <!-- </div> -->
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { computed, onMounted, ref } from 'vue';
import axios from "axios";

const props = defineProps({
    voteableModel: String,
    voteableId: Number,
})

let voteResult = ref();
let voteStatus = ref();

const vote = (type) => {
    router.post(route('votes.store', { voteableModel: props.voteableModel, voteableType: type, voteableId: props.voteableId }),
        {
            preserveScroll: true,
        });
    if (type === 'upvote') {
        voteResult.value++;
    } else if (type === 'downvote') {
        voteResult.value--;
    }
}

const getVotes = async () => {
    const { data } = await axios.get(route('get.votes', { voteableId: props.voteableId }));
    voteResult.value = data;
}

const getVoteStatus = async () => {
    const { data } = await axios.get(route('vote.status', { voteableId: props.voteableId }));
    voteStatus.value = data;
}

onMounted(() => {
    getVotes();
    getVoteStatus();
});
</script>