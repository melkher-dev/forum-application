<template>
    <div v-if="$page.props.auth.user" class="flex justify-start mt-5">
        <button @click="vote('downvote')" class="btn btn-error btn-outline btn-sm mx-1" :class="{
            'btn-active': voteStatus === 'downvote',
            'btn-disabled': model?.user_id || true
        }">-</button>
        <h6 class="mt-1 mx-2">{{ voteResult || '...' }}</h6>
        <button @click="vote('upvote')" class="btn btn-primary btn-outline btn-sm mx-1" :class="{
            'btn-active': voteStatus === 'upvote',
            'btn-disabled': model?.user_id || true
        }">+</button>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { onMounted, ref, computed } from 'vue';
import axios from "axios";

const props = defineProps({
    model: Object,
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
    if (type === 'upvote' && voteStatus.value === 'upvote') {
        voteResult.value--;
        voteStatus.value = null;
    } else if (type === 'downvote' && voteStatus.value === 'downvote') {
        voteResult.value++;
        voteStatus.value = null;
    } else if (type === 'upvote') {
        voteResult.value++;
        voteStatus.value = 'upvote';
    } else if (type === 'downvote') {
        voteResult.value--;
        voteStatus.value = 'downvote';
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