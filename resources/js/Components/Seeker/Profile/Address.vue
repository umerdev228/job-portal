<script setup>

import {useForm} from "@inertiajs/vue3";
import { ref } from 'vue';

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    address: {
        type: Object,
        default: {},
    },
    countries: {
        type: Array,
        default: [],
    },
    cities: {
        type: Array,
        default: [],
    },
});
let citiesFiltered = ref([]);

const form = useForm({
    country_id: 0,
    city_id: 0,
    address: '',
    postal_code: '',
});

const updatePassword = () => {
    form.put(route('seeker.profile.address.update'), {
        preserveScroll: true,
        preserveState: true,
        onError: () => {

        },
    });
};

function filterCities() {
    citiesFiltered.value = props.cities.filter(city => city.country_id === form.country_id)
}
</script>

<template>
    <div class="mt-10">
        <form enctype="multipart/form-data"
              @submit.prevent="updatePassword">

            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="mb-6 mx-2">
                    <label for="country_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Country</label>
                    <select v-on:change="filterCities()" v-model="form.country_id" id="country_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="0">Choose a Country</option>
                        <option v-for="country in countries" :value="country.id">{{ country.title }}</option>
                    </select>
                </div>
                <div class="mb-6 mx-2">
                    <label for="city_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select City</label>
                    <select v-model="form.city_id" id="city_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="0">Choose a City</option>
                        <option v-for="city in citiesFiltered" :value="city.id">{{ city.title }}</option>
                    </select>
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="postal_code">Postal Code</label>
                    <input id="postal_code" v-model="form.postal_code"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="postal_code" placeholder="Postal Code" type="text">
                </div>

                <div class="mb-6 mx-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                    <textarea v-model="form.address" id="postal_code" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Address"></textarea>
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
