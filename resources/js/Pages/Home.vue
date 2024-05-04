<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

defineProps({
    auth: {
        type: Object,
        default: {},
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
    jobs: {
        type: Array,
        required: true,
    },
    category_id: {
        type: Number,
        required: true,
        default: 0,
    },
});


const form = useForm({
    category_id: 0,
});

const truncateDescription = (description) => {
    const words = description.split(' ');
    if (words.length > 15) {
        return words.slice(0, 15).join(' ') + '...';
    }
    return description;
};

function filterJob(category_id) {
    form.category_id = category_id;
    form.post('/', {
        preserveState: true,
        preserveScroll: true,
    })
}


</script>

<template>
    <Head title="Home"/>
    <FrontendLayout :auth="auth">


        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img alt="..."
                         class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                         src="/images/slider/1.jpg">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img alt="..."
                         class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                         src="/images/slider/2.jpg">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img alt="..."
                         class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                         src="/images/slider/3.jpg">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img alt="..."
                         class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                         src="/images/slider/4.jpg">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button aria-current="true" aria-label="Slide 1" class="w-3 h-3 rounded-full" data-carousel-slide-to="0"
                        type="button"></button>
                <button aria-current="false" aria-label="Slide 2" class="w-3 h-3 rounded-full"
                        data-carousel-slide-to="1"
                        type="button"></button>
                <button aria-current="false" aria-label="Slide 3" class="w-3 h-3 rounded-full"
                        data-carousel-slide-to="2"
                        type="button"></button>
                <button aria-current="false" aria-label="Slide 4" class="w-3 h-3 rounded-full"
                        data-carousel-slide-to="3"
                        type="button"></button>
            </div>
            <!-- Slider controls -->
            <button
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev
                type="button">
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                 fill="none" viewBox="0 0 6 10" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 1 1 5l4 4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
            </button>
            <button
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next
                type="button">
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                 fill="none" viewBox="0 0 6 10" xmlns="http://www.w3.org/2000/svg">
                <path d="m1 9 4-4-4-4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
            </button>
        </div>

        <div
            class="flex justify-between border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 p-4">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl ">
                Jobs
            </h1>
        </div>

        <div class="flex items-center justify-end py-4 md:py-8 flex-wrap">
            <button
                :class="form.category_id === 0 ? 'bg-blue-700 text-white' : 'bg-white'"
                class="text-blue-700 hover:text-white border border-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3"
                type="button" v-on:click="filterJob(0)">
                All categories
            </button>
            <button v-for="category in categories" :class="form.category_id === category.id ? 'bg-blue-700 text-white' : 'bg-white'"
                    class="text-blue-700 hover:text-white border border-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3"
                     type="button" v-on:click="filterJob(category.id)">

                {{ category.title }}
            </button>
        </div>
        <div class="grid grid-cols-4 md:grid-cols-4 gap-4">
            <div v-for="job in jobs"
                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <Link :href="route('jobs.show', job.id)">
                    <div class="image-container">
                        <img alt="" class="rounded-t-lg object-cover" :src="job.image"/>
                    </div>
                    <!-- <img alt="" class="rounded-t-lg" :src="job.image"/> -->
                </Link>
                <div class="p-5">
                    <Link :href="route('jobs.show', job.id)">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ job.title }}</h5>
                    </Link>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ truncateDescription(job.description) }}</p>
                    <Link v-if="auth.user && auth.applied_jobs.find(j => j === job.id)" disabled class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-gray-400 dark:focus:ring-blue-800">
                        Applied
                    </Link>
                    <Link v-else class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                          :href="route('jobs.show', job.id)">
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




    </FrontendLayout>
</template>

<style>
  .image-container {
    width: 100%;
    height: 200px; /* Adjust the height as needed */
    overflow: hidden;
    position: relative;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
