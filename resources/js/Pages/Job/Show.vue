<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
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
    applied: {
        type: Boolean,
        required: true,
        default: false,
    },
});


const form = useForm({
    job_id: '',
});

function applyJob() {
    form.post(route('job.apply', props.job.id));
}

</script>

<template>
    <Head :title="job.title"/>
    <FrontendLayout :auth="auth">
        <div
            class="flex justify-between border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 my-4 p-4">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl ">
                Job
            </h1>
        </div>
        <!-- <div id="gallery" class="relative w-full">
            
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <div class="duration-700 ease-in-out flex justify-center">
                    <img :src="job.image" alt="">
                </div>
            </div>
        </div> -->
        <div id="gallery" class="relative w-full flex justify-center">
    <div class="image-container">
        <img :src="'/storage/'+(job.image.replace('public',''))" alt="">
    </div>
</div>
       
        <Link v-if="!auth.user" :href="route('login')"
              class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Login to Apply Now
            <svg aria-hidden="true" class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                 fill="none" viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"/>
            </svg>
        </Link>
        <button v-else-if="!applied"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                data-modal-target="progress-modal" data-modal-toggle="progress-modal"
                type="button">
            Apply Now
            <svg aria-hidden="true" class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                 fill="none" viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"/>
            </svg>
        </button>
        <button v-else
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-gray-400 dark:focus:ring-blue-800"
                disabled>
            Applied
        </button>

        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">
            {{ job.title }}</h1>
        <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Experience: {{ job.experience }}
            Year</p>
        <div class="w-[80%]">
            <span v-for="skill in job.skills"
                  class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                {{ skill.title }}
            </span>
        </div>


        <p class="mb-3 text-gray-500 dark:text-gray-400">
            {{ job.description }}
        </p>

        <!-- Main modal -->
        <div v-if="auth.user" id="progress-modal" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
             tabindex="-1">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="p-4 md:p-5">
                        <img :src="'/storage/'+(auth.user.image.replace('public',''))" width="150px">

                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">{{ auth.user.first_name }}
                            {{ auth.user.last_name }}</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">{{ auth.user.seeker.about }}</p>

                        <div class="w-[80%]">
                            <span v-for="skill in auth.user.seeker.skills"
                                  class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                {{ skill.title }}
                            </span>
                        </div>


                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            data-modal-target="progress-modal" data-modal-toggle="progress-modal"
                            type="button" v-on:click="applyJob()">
                            Apply Now
                            <svg aria-hidden="true" class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                                 fill="none" viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </FrontendLayout>
</template>

<style>
#gallery {
    width: 100%;
}

.image-container {
    width: 50%;
    /* Center the container horizontally */
    margin: 0 auto;
    /* Define other styles for the container */
    overflow: hidden;
    border-radius: 8px; /* Adjust as needed */
}

.image-container img {
    width: 100%;
    /* Maintain aspect ratio and cover the container */
    height: auto;
    object-fit: cover;
}


/* Designing for scroll-bar */
::-webkit-scrollbar {
            width: 8px;
        }
     
        /* Track */
        ::-webkit-scrollbar-track {
            background: gainsboro;
            border-radius: 8cqmax;
        }
     
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background:rgb(202, 194, 194);
            border-radius: 8px;
        }
     
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

</style>
