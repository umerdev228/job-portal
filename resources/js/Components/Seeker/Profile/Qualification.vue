<script setup>

import {useForm} from "@inertiajs/vue3";

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

const updateQualification = () => {
    form.put(route('seeker.profile.qualification.update'), {
        preserveScroll: true,
        preserveState: true,
        onError: () => {

        },
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <div class="mt-10">
        <form enctype="multipart/form-data"
              @submit.prevent="updateQualification">

            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="status">University</label>
                    <select id="university_id" v-model="form.university_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="university_id">
                        <option disabled selected value="0">Choose a University</option>
                        <option v-for="university in universities" :value="university.id">{{
                                university.title
                            }}
                        </option>
                    </select>
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="status">Degree
                        Title</label>
                    <select id="status" v-model="form.degree_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="status">
                        <option disabled selected value="0">Choose a Degree</option>
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
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="postal_code">To</label>
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

    <div class="my-5">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3" scope="col">
                        University
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Degree
                    </th>
                    <th class="px-6 py-3" scope="col">
                        From
                    </th>
                    <th class="px-6 py-3" scope="col">
                        To
                    </th>
                    <th class="px-6 py-3" scope="col">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="qualification in qualifications"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                        {{ qualification.university ? qualification.university.title : 'N/A' }}
                    </th>
                    <td class="px-6 py-4">
                        {{ qualification.degree ? qualification.degree.title : 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ qualification.from }}
                    </td>
                    <td class="px-6 py-4">
                        {{ qualification.to }}
                    </td>
                    <td class="px-6 py-4 text-right flex">
                        <Link class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-800 dark:text-white"
                                 fill="currentColor" height="24" viewBox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd"
                                      d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                      fill-rule="evenodd"/>
                            </svg>
                        </Link>
                        <Link class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-800 dark:text-white"
                                 fill="none" height="24" viewBox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"/>
                            </svg>
                        </Link>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>


    </div>


</template>

<style scoped>

</style>
