<script setup>

import {Head, Link} from "@inertiajs/vue3";
import SeekerLayout from "@/Layouts/SeekerLayout.vue";

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    jobs: {
        type: Array,
        default: [],
    },
    notifications: {
        type: Array,
        default: [],
    },

});
</script>

<template>
    <Head title="Update Profile | Jobs Hub"/>
    <SeekerLayout :auth="auth" :notifications="notifications">
        <div class="flex justify-between">
            <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">
                Applied Job
            </h1>
        </div>

        <nav aria-label="Breadcrumb" class="flex my-4">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <Link
                        :href="route('seeker.dashboard')"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        Dashboard
                    </Link>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1"
                             fill="none" viewBox="0 0 6 10" xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 9 4-4-4-4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"/>
                        </svg>
                        <Link
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                            href=""> Applied Job
                        </Link>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3" scope="col">
                            Title
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Details
                        </th>
                        <th class="px-6 py-3" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="job in jobs.data"  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                            {{ job.job.title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ job.job.title }}
                        </td>
                         <td class="px-6 py-4 text-right flex">
                            <Link class="font-medium text-blue-600 dark:text-blue-500 hover:underline" :href="route('jobs.show',job.job_id)" target="_blank">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                            </Link>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
                <!-- Apply  Pagination  -->
         <nav aria-label="Page navigation example" class="mt-6">
            <ul class="inline-flex -space-x-px text-sm">
                <li>
                    <Component :is="jobs.links[0].url ? Link : 'span'"
                               :class="{ 'font-bold': jobs.links[0].active, 'hover:text-white hover:font-bold': jobs.links[0].active }"
                               :href="jobs.links[0].url"
                               class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                               v-html="jobs.links[0].label"/>
                </li>
                <li v-for="(link, index) in jobs.links.slice(1, -1)" :key="index">
                    <Component :is="link.url ? Link : 'span'"
                               :class="{'text-white': !link.url,  'font-bold': link.active}"
                               :href="link.url"
                               class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                               v-html="link.label"/>
                </li>
                <li>
                    <Component :is="jobs.links.slice(-1)[0].url ? Link : 'span'"
                               :class="{ 'font-bold': jobs.links.slice(-1)[0].active, 'hover:text-white hover:font-bold': jobs.links.slice(-1)[0].active }"
                               :href="jobs.links.slice(-1)[0].url"
                               class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                               v-html="jobs.links.slice(-1)[0].label"/>
                </li>
            </ul>
        </nav>

    </SeekerLayout >
</template>

<style scoped>

</style>
