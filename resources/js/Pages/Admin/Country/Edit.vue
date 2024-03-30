<script setup>
import {Link, Head, useForm} from '@inertiajs/vue3';

import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    country: {
        type: Object,
        default: {},
    },
});

const form = useForm({
    title: props.country.title,
    iso2: props.country.iso2,
    iso3: props.country.iso3,
});


</script>

<template>
    <Head title="Edit Countries | Jobs Hub"/>
    <AdminLayout :auth="auth">
        <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">
            Edit Countries
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
                        <Link :href="route('admin.countries.index')"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                            href="">Countries
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
                            href="">{{ country.title }}
                        </Link>
                    </div>
                </li>
            </ol>
        </nav>


        <form enctype="multipart/form-data"
              @submit.prevent="form.put(route('admin.countries.update', country.id))">

            <div class="grid grid-cols-1 sm:grid-cols-1">

                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="title">Name</label>
                    <input id="title" v-model="form.title"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="title" placeholder="Title" type="text">
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="iso2">Iso2</label>
                    <input id="iso2" v-model="form.iso2"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="iso2" placeholder="Iso2" type="text">
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="iso3">Iso3</label>
                    <input id="iso3" v-model="form.iso3"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="iso3" placeholder="Iso3" type="text">
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
