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
                    <img :src="job.image" alt="">
                </div>
            </div>
        </div>
        <Link class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                       href="#">
                        Apply Now
                        <svg aria-hidden="true" class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                             fill="none" viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"/>
                        </svg>
                    </Link>

        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">{{ job.title }}</h1>
        <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Experience: {{ job.experience }} Year</p>

        <p class="mb-3 text-gray-500 dark:text-gray-400">
            {{ job.description }}
        </p>


    </FrontendLayout>
</template>

<style>

</style>
