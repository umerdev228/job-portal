<script setup>
import {Head} from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    user: {
        type: Array,
        required: true,
    },
    notifications: {
        type: Array,
        default: [],
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

           <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
               <div class="duration-700 ease-in-out flex justify-center">
                <img :src="'/storage'+(user.image.replace('public',''))" alt="" class="rounded-t-lg"/>
               </div>
           </div>
       </div>


       <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl"> {{ user.first_name }} {{ user.last_name }}</h1>
       <template v-for="skill in user.seeker.skills">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium me-2 mb-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                        {{ skill.title }},
                    </span>
                </template>
       <p class="mb-3 text-black-500 dark:text-black-400">
        {{ user.seeker.about }}
       </p>



    </FrontendLayout>
</template>

<style>
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
