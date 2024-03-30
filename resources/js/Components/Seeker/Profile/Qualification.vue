<script setup>

import {useForm} from "@inertiajs/vue3";
import { ref } from 'vue';

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    universities: {
        type: Array,
        default: [],
    },
    degrees: {
        type: Array,
        default: [],
    },
    qualifications: {
        type: Array,
        default: [],
    },
});

console.log(props)
const form = useForm({
    university_id: 0,
    degree_id: 0,
    from: '',
    to: '',
});

const updatePassword = () => {
    form.put(route('seeker.profile.address.update'), {
        preserveScroll: true,
        preserveState: true,
        onError: () => {

        },
    });
};

</script>

<template>
    <div class="mt-10">
        <form enctype="multipart/form-data"
              @submit.prevent="updatePassword">

            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="status">University</label>
                    <select v-model="form.university_id" id="university_id" name="university_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="0" disabled selected>Choose a University</option>
                        <option v-for="university in universities" :value="university.id">{{ university.title }}</option>
                    </select>
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="status">Degree Title</label>
                    <select v-model="form.degree_id" id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="0" disabled selected>Choose a Degree</option>
                        <option v-for="degree in degrees" :value="degree.id">{{ degree.title }}</option>
                    </select>
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="from">From</label>
                    <input id="from" v-model="form.from"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="from" placeholder="From Date" type="date">
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="postal_code">To</label>
                    <input id="to" v-model="form.to"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="to" placeholder="To Date" type="date">
                </div>

            </div>

            <button
                class="text-white bg-indigo-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="submit">
                Submit
            </button>
        </form>
    </div>
</template>

<style scoped>

</style>
