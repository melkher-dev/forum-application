<template>
    <div class="grid grid-cols-1 flex justify-center mx-3">
        <div class="card w-2/3 bg-base-100 shadow-xl mt-5">
            <div class="card-body">
                <div>
                    <div class="card-actions justify-start">
                        <h3>{{ comment.body }}</h3>
                    </div>
                    <div class="card-actions justify-end">
                        <h6><span style="color:blue">by: </span>{{ comment.user.name }}</h6>
                    </div>
                    <div class="card-actions justify-end">
                        <h6>{{ comment.created_at }}</h6>
                    </div>
                </div>
                <div v-if="$page.props.auth.user">
                    <div v-if="$page.props.auth.user.id === comment.user.id" class="card-actions justify-end">
                        <!-- buttons -->
                        <button @click="deleteComment(comment.id)"
                            class="btn btn-outline btn-error btn-sm">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";

const props = defineProps({
    comment: Object,
})

const deleteComment = (id) => {
    if (confirm('Are you sure want to delete this Comment?')) {
        router.delete(route('comments.destroy', id), {
            preserveScroll: true,
        });
    }
}
</script>