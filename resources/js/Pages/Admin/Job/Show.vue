<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    job: {
        type: Array,
        required: true,
    },
  
    job_skills: {
        type: Array,
        default: [],
    },
});


</script>

<template>
    <Head :title="job.title"/>
    <AdminLayout :auth="auth">
        <div class="flex justify-between border-2 border-white-200 border-dashed rounded-lg dark:border-gray-700 my-4 p-4">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-white md:text-4xl lg:text-5xl">
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
        
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-white md:text-5xl lg:text-6xl">
           {{ job.title }}
        </h1>
        <p class="text-lg font-normal text-gray-500 lg:text-xl text-white">Experience: {{ job.experience }}
            Year</p>
        <div class="w-[80%]">
            <span v-for="skill in job.skills"
                  class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 text-white">
               Skills : {{ skill.title }}
            </span>
        </div>

       <h3 class="text-lg font-normal text-gray-500 lg:text-xl text-white">Description =></h3>
        <p class="mb-3 text-gray-500 text-white">
            {{ job.description }}
        </p>

        <h1 class="mb-4 text-1xl font-extrabold leading-none tracking-tight text-white md:text-2xl lg:text-2xl">
          Status : {{ job.status }}
        </h1>

    </AdminLayout>
</template>

<style>

</style>
