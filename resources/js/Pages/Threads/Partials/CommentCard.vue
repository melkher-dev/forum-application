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
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    comment: Object,
})
</script>