<script setup>
import {Link, Head, useForm} from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref } from 'vue';

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    city: {
        type: Object,
        default: {},
    },
    countries: {
        type: Array,
        default: [],
    },
});

let citiesFiltered = ref([]);

const form = useForm({
    title: props.city.title,
    country_id: props.city.country_id,

});
function filterCities() {
    citiesFiltered.value = props.cities.filter(city => city.country_id === form.country_id);
}

</script>

<template>
    <Head title="Edit Cities | Jobs Hub"/>
    <AdminLayout :auth="auth">
        <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">
            Edit Cities
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
                        <Link :href="route('admin.cities.index')"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                            href="">Cities
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
                            href="">{{ city.title }}
                        </Link>
                    </div>
                </li>
            </ol>
        </nav>


        <form enctype="multipart/form-data"
              @submit.prevent="form.put(route('admin.cities.update', city.id))">

            <div class="grid grid-cols-1 sm:grid-cols-1">

                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="title">Name</label>
                    <input id="title" v-model="form.title"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="title" placeholder="Title" type="text">
                </div>
                <div class="mb-6 mx-2">
                    <label for="country_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Country</label>
                    <select v-on:change="filterCities()" v-model="form.country_id" id="country_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="0">Choose a Country</option>
                        <option v-for="country in countries" :value="country.id">{{ country.title }}</option>
                    </select>
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
