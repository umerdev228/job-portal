<script setup>
import { Head } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    notifications: {
        type: Array,
        default: []
    },
    notification: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Notification Detail" />
    <AdminLayout :auth="auth" :notifications="notifications">
        <div class="flex justify-between border-2 border-white-200 border-dashed rounded-lg dark:border-gray-700 my-4 p-4">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-white md:text-4xl lg:text-5xl">
                Notification Detail
            </h1>
        </div>

        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h2 class="text-white  text-2xl font-bold mb-4">Notification</h2>
            <p class="text-white"><strong>Message:</strong> {{ notification.message }}</p>
            <p class="text-white">
                <strong>Job Link:</strong>
                <a :href="notification.link" target="_blank" class="text-teal-400 hover:underline">
                    View Job
                </a>
            </p>
            <p class="text-white"><strong>Created At:</strong> {{ notification.created_at }}</p>

        </div>
    </AdminLayout>
</template>

<style>
/* Add your styles here */
</style>
