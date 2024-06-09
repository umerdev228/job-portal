<script setup>

import {Head, Link, useForm} from "@inertiajs/vue3";
import ProviderLayout from "@/Layouts/ProviderLayout.vue";
import Multiselect from 'vue-multiselect'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    job: {
        type: Object,
        default: {},
    },
    categories: {
        type: Array,
        default: [],
    },
    skills: {
        type: Array,
        default: [],
    },
    job_skills: {
        type: Array,
        default: [],
    },
    notifications: {
        type: Array,
        default: [],
    },
});

const form = useForm({
    category_id: props.job.category_id,
    title: props.job.title,
    experience: props.job.experience,
    description: props.job.description,
    image: props.job.image,
    skills: props.job_skills,
});

function updateJob() {
    // form.put(route('provider.jobs.update',job.id), { onSuccess: () => editing = false })

    router.post(route('provider.jobs.update',props.job.id), {
        _method: 'put',
        category_id: form.category_id,
        title: form.title,
        experience: form.experience,
        description: form.description,
        image: form.image,
        skills: form.skills,
    })
}

</script>

<template>
    <Head title="Update Job | Jobs Hub"/>
    <ProviderLayout :auth="auth" :notifications="notifications">
        <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">
            Edit Jobs
        </h1>


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
                        <Link :href="route('provider.jobs.index')"
                              class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                              href="">Jobs
                        </Link>
                    </div>
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
                            href="">{{ job.title }}
                        </Link>
                    </div>
                </li>
            </ol>
        </nav>


        <form enctype="multipart/form-data"
              @submit.prevent="updateJob()">

            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="title">Title</label>
                    <input id="title" v-model="form.title"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="title" placeholder="Title" type="text">
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="category_id">
                        Choose Category
                    </label>
                    <select id="category_id" v-model="form.category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="category_id">
                        <option disabled selected value="0">Choose a Category</option>
                        <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                    </select>
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="experience">Experience
                        Required (Years)</label>
                    <input id="experience" v-model="form.experience"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="experience" placeholder="Experience" type="number">
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="file_input">Image</label>
                    <input id="file_input"
                           aria-describedby="file_input_help"
                           class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" @input="form.image = $event.target.files[0]">
                    <p id="file_input_help" class="mt-1 text-sm text-gray-500 dark:text-gray-300">SVG, PNG, JPG or GIF
                        (MAX. 800x400px).</p>
                </div>

            </div>
            <div class="grid grid-cols-1 sm:grid-cols-1">
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="description">Description</label>
                    <textarea id="description" v-model="form.description"
                              aria-describedby="user_avatar_help"
                              class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                              name="description" placeholder="Experience"></textarea>
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="status">Skills</label>
                    <multiselect v-model="form.skills" :clear-on-select="false" :close-on-select="false" :multiple="true"
                                 :options="skills" :preselect-first="true" :preserve-search="true"
                                 label="title" placeholder="Choose Skills" track-by="id">
                        <template slot="selection" slot-scope="{ values, search, isOpen }">
                            <span v-if="skills.length" v-show="!isOpen" class="multiselect__single">{{ skills.length }} options selected</span>
                        </template>
                    </multiselect>
                </div>

            </div>

            <button
                class="text-white bg-indigo-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="submit">
                Submit
            </button>
        </form>

    </ProviderLayout>
</template>

<style scoped>

</style>
