<script setup>
import {Head} from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
   


});

</script>

<template>
    <Head title="Home"/>
    <FrontendLayout :auth="auth">
        <div
            class="flex justify-center border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 my-4 p-4">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl ">
                About Us
            </h1>
        </div>
        <p class="mb-3 text-center text-black-500 dark:text-black-400">
            Discover tailored job listings, streamline recruitment, and unlock career success. With personalized recommendations, resume-building tools, and efficient recruitment features, Jobs-hub empowers both job seekers and employers. Join our trusted network today and embark on your journey to professional fulfillment. Welcome to Jobs-hub, where opportunities meet aspirations.
        </p>


    </FrontendLayout>
</template>

<style>

</style>
