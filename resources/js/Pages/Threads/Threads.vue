<template>
    <authenticated-layout>
        <div v-if="$page.props.auth.user" class="flex justify-center mt-5">
            <button class="btn btn-outline btn-primary">Create New Thread</button>
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>