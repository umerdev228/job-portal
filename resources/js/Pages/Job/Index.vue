<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
import {ref, watch} from 'vue';

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
    filters: {
        type: String,
        required: true,
        default: null,
    },
});

let search = ref(props.filters);

const form = useForm({
    search: props.filters,
});


watch(search, value => {
    form.search = search.value
    form.get('/jobs', {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
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

        <form class="max-w-md mx-auto">

            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400"
                         fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" stroke="currentColor"
                              stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"/>
                    </svg>
                </div>
                <input v-model="search"
                       class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Search Jobs..."
                       required type="text"/>
                <button
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="submit">
                    Search
                </button>
            </div>
        </form>
        <div
            class="flex justify-between border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 my-4 p-4">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl ">
                Jobs
            </h1>
            <!-- <input v-model="search" type="text" placeholder="search..." class="border px-2 rounded lg"> -->
        </div>


        <div class="grid grid-cols-4 md:grid-cols-4 gap-4">
            <div v-for="job in jobs.data"
                 class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <Link :href="route('jobs.show', job.id)">
                    <img :src="job.image" alt="" class="rounded-t-lg"/>
                </Link>
                <div class="p-5">
                    <Link :href="route('jobs.show', job.id)">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{
                                job.title
                            }}</h5>
                    </Link>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        {{ truncateDescription(job.description) }}</p>
                    <Link v-if="auth.user && auth.applied_jobs.find(j => j === job.id)"
                          class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-gray-400 dark:focus:ring-blue-800"
                          disabled>
                        Applied
                    </Link>
                    <Link v-else
                          :href="route('jobs.show', job.id)"
                          class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
                :is="link.url ? Link : 'span'"

                v-for="link in jobs.links"
                :class="{'text-gray-500': !link.url,'font-bold':link.active}"
                :href="link.url"
                class="px-1"
                v-html="link.label"
            />

        </div>


    </FrontendLayout>
</template>

<style>

</style>
