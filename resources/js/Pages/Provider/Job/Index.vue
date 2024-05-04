<script setup>
import {Link, Head} from '@inertiajs/vue3';
import ProviderLayout from "@/Layouts/ProviderLayout.vue";


const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    jobs: {
        type: Array,
        default: [],
    }
});
 
const truncateDescription = (description) => {
    const words = description.split(' ');
    if (words.length > 8) {
        return words.slice(0, 8).join(' ') + '...';
    }
    return description;
};


</script>

<template>
    <Head title="Jobs | Jobs Hub"/>
    <ProviderLayout :auth="auth">
        <div class="flex justify-between">
            <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">
                Jobs
            </h1>
            <Link :href="route('provider.jobs.create')"
                  class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center h-10 p-2">
                Create
            </Link>
        </div>

        <nav aria-label="Breadcrumb" class="flex my-4">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <Link
                        :href="route('provider.dashboard')"
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
                            href="">Jobs
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
                            Experience 
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Description
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Status
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="job in jobs.data"  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                            {{ job.title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ job.experience }}
                        </td>
                        <td class="px-6 py-4">
                            {{truncateDescription (job.description) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ job.status }}
                        </td>
                        <td class="px-6 py-4 text-right flex">
                            <Link class="font-medium text-blue-600 dark:text-blue-500 hover:underline" :href="route('provider.jobs.edit',job.id)">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd"/>
                                </svg>
                            </Link>
                            <Link class="font-medium text-blue-600 dark:text-blue-500 hover:underline"  :href="route('provider.jobs.destroy',job.id)" method="delete">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
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

    </ProviderLayout>
</template>

<style scoped>

</style>
