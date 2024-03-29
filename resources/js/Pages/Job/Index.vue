<script setup>
import {Head} from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },

    jobs: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },

});

const truncateDescription = (description) => {
    const words = description.split(' ');
    if (words.length > 15) {
        return words.slice(0, 15).join(' ') + '...';
    }
    return description;
};

</script>

<template>
    <Head title="Home"/>
    <FrontendLayout :auth="auth">



        <div class="flex justify-between border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 my-4 p-4">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl ">
                Jobs
            </h1>
        </div>



        <div class="grid grid-cols-4 md:grid-cols-4 gap-4">
            <div v-for="job in jobs.data"
                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <Link :href="route('jobs.show', job.id)">
                    <img alt="" class="rounded-t-lg" :src="job.image"/>
                </Link>
                <div class="p-5">
                    <Link :href="route('jobs.show', job.id)">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ job.title }}</h5>
                    </Link>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{truncateDescription(job.description)}}</p>
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
                </div>
            </div>

        </div>

         <!-- Pagination Section -->
<div class="mt-6 text-black">
    <Component
        :is="link.url ? 'Link' : 'span'"
        v-for="link in jobs.links"
        :href="link.url"
        v-html="link.label"
        class="px-1"
        :class="{'text-gray-500': !link.url, 'font-bold': link.active}"
    />
</div>


    </FrontendLayout>
</template>

<style>

</style>
