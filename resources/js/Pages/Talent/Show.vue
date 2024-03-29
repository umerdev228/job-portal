<script setup>
import {Head} from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    job: {
        type: Array,
        required: true,
    },


});

</script>

<template>
    <Head title="Home"/>
    <FrontendLayout :auth="auth">
        <div
            class="flex justify-between border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 my-4 p-4">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl ">
                Job
            </h1>
        </div>


        <div id="gallery" class="relative w-full">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <div class="duration-700 ease-in-out flex justify-center">
                    <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg" alt="">
                </div>
            </div>
        </div>


        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">We invest in the world’s potential</h1>
        <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>

        <p class="mb-3 text-gray-500 dark:text-gray-400">
            Track work across the enterprise through an open, collaborative platform. Link issues across Jira and ingest
            data from other software development tools, so your IT support and operations teams have richer contextual
            information to rapidly respond to requests, incidents, and changes.
        </p>


    </FrontendLayout>
</template>

<style>

</style>
