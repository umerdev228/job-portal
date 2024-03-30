<script setup>
import {useForm} from "@inertiajs/vue3";
import Multiselect from 'vue-multiselect'

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    profile: {
        type: Object,
        default: {},
    },
    skills: {
        type: Array,
        default: [],
    },
    user_skills: {
        type: Array,
        default: [],
    },
});

const form = useForm({
    first_name: props.auth.user.first_name,
    last_name: props.auth.user.last_name,
    dob: props.profile.dob,
    phone: props.profile.phone,
    gender: props.profile.gender,
    image: '',
    skills: props.user_skills,
});

</script>

<template>
    <div class="mt-10">
        <form enctype="multipart/form-data"
              @submit.prevent="form.post(route('seeker.profile.update'))">

            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="name">First Name</label>
                    <input id="name" v-model="form.first_name"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="first_name" placeholder="Title" type="text">
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="name">Last Name</label>
                    <input id="name" v-model="form.last_name"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="last_name" placeholder="Title" type="text">
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="name">Date of Birth</label>
                    <input id="name" v-model="form.dob"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="dob" placeholder="DOB" type="date">
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="name">Phone</label>
                    <input id="phone" v-model="form.phone"
                           aria-describedby="user_avatar_help"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           name="phone" placeholder="Phone" type="tel">
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="status">Choose a Gender</label>
                    <select v-model="form.gender" id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="none">Not to reveal</option>
                    </select>
                </div>

                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Profile Image</label>
                    <input @input="form.image = $event.target.files[0]"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
                </div>
                <div class="mb-6 mx-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="status">Choose a Skill</label>
                    <multiselect v-model="form.skills" :options="skills" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Choose Skills" label="title" track-by="id" :preselect-first="true">
                        <template slot="selection" slot-scope="{ values, search, isOpen }">
                            <span class="multiselect__single" v-if="skills.length" v-show="!isOpen">{{ skills.length }} options selected</span>
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
    </div>
</template>

<style scoped>

</style>
