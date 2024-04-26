<script setup>

import {Head, Link, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Multiselect from 'vue-multiselect'

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
});



const form = useForm({
    category_id: props.job.category_id || 0,
    title: props.job.title || '',
    experience: props.job.experience || '',
    description: props.job.description || '',
    status: props.job.status || '',
    image: props.job.image || '',
    skills: props.job_skills || [],
    is_feature: props.job.is_feature || false, // Initialize with false instead of ''
});


</script>

<template>
    <Head title="Update Job | Jobs Hub"/>
    <AdminLayout :auth="auth">
        <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">
           Edit Jobs
        </h1>


        <nav aria-label="Breadcrumb" class="flex my-4">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <Link
                        :href="route('admin.dashboard')"
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
                        <Link :href="route('admin.jobs.index')"
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
              @submit.prevent="form.put(route('admin.jobs.update',job.id))">

            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="title">Title</label>
                    <input id="title" v-model="form.title"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="title" placeholder="Title" type="text">
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="category_id">Choose Category</label>
                    <select v-model="form.category_id" id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="0" disabled selected>Choose a Category</option>
                        <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                    </select>
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="experience">Experience Required (Years)</label>
                    <input id="experience" v-model="form.experience"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="experience" placeholder="Experience" type="number">
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Image</label>
                    <input @input="form.image = $event.target.files[0]"
                           class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
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
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="status">Skills</label>
                    <multiselect v-model="form.skills" :options="skills" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Choose Skills" label="title" track-by="id" :preselect-first="true">
                        <template slot="selection" slot-scope="{ values, search, isOpen }">
                            <span class="multiselect__single" v-if="skills.length" v-show="!isOpen">{{ skills.length }} options selected</span>
                        </template>
                    </multiselect>
                </div>
                <div class="mb-6 mx-2">
                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Status</h3>
                   <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                       <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                           <div class="flex items-center ps-3">
                               <input v-model="form.status" id="pending" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" value="pending">
                               <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"  for="pending">pending</label>
                           </div>
                       </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                             <div class="flex items-center ps-3">
                                <input v-model="form.status" id="approved" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" value="approved">
                                <label  class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="approved">Approved</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input v-model="form.status" id="closed" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" value="closed">
                                <label  class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="closed">Closed</label>
                            </div>
                        </li>
                        <li class="w-full dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input v-model="form.status" id="deadline" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" value="deadline">
                                <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="deadline" >Deadline</label>
                            </div>
                        </li>
                    </ul>
                </div>


              <div class="mb-6 mx-2">
                  <label class="flex items-center text-sm font-medium text-gray-900 dark:text-white" for="is_feature">
                    <input id="is_feature" v-model="form.is_feature" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <span class="ml-2">Feature</span>
                   </label>
               </div>

            </div>

            <button
                class="text-white bg-indigo-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="submit">
                Submit
            </button>
        </form>

    </AdminLayout>
</template>

<style scoped>

</style>
