<script setup>

import {Head, Link, useForm} from "@inertiajs/vue3";
import Profile from "@/Components/Seeker/Profile/Profile.vue"
import {ref} from "vue";
import Password from "@/Components/Seeker/Profile/Password.vue";
import Address from "@/Components/Seeker/Profile/Address.vue";
import SeekerLayout from "@/Layouts/SeekerLayout.vue";
import Qualification from "@/Components/Seeker/Profile/Qualification.vue";

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    profile: {
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
    skills: {
        type: Array,
        default: [],
    },
    cities: {
        type: Array,
        default: [],
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
    user_skills: {
        type: Array,
        default: [],
    },
});

let activeMenu = ref('Profile');

</script>

<template>
    <Head title="Update Profile | Jobs Hub"/>
    <SeekerLayout :auth="auth">
        <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">
            Profile
        </h1>
        <nav aria-label="Breadcrumb" class="flex my-4">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <Link
                        :href="route('seeker.dashboard')"
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
                        <Link class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                              href="">Profile
                        </Link>
                    </div>
                </li>
            </ol>
        </nav>





        <div class="border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <li class="me-2">
                    <a v-on:click="activeMenu = 'Profile'" href="javascript:void(0)" :class="activeMenu === 'Profile' ? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'" class="inline-flex items-center justify-center p-4 group rounded-t-lg border-b-2">
                        <svg :class="activeMenu === 'Profile' ? 'text-blue-600 dark:text-blue-500' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'" class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                        </svg>Profile
                    </a>
                </li>
                <li class="me-2">
                    <a v-on:click="activeMenu = 'Password'" href="javascript:void(0)" :class="activeMenu === 'Password' ? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'" class="inline-flex items-center justify-center p-4 group rounded-t-lg border-b-2" aria-current="page">
                        <svg :class="activeMenu === 'Password' ? 'text-blue-600 dark:text-blue-500' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'" class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
                        </svg>

                        Password
                    </a>
                </li>
                <li class="me-2">
                    <a v-on:click="activeMenu = 'Address'" href="javascript:void(0)" :class="activeMenu === 'Address' ? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'" class="inline-flex items-center justify-center p-4 group rounded-t-lg border-b-2">
                          <svg :class="activeMenu === 'Address' ? 'text-blue-600 dark:text-blue-500' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'" class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                        </svg>Address
                    </a>
                </li>
                <li class="me-2">
                    <a v-on:click="activeMenu = 'Qualification'" href="javascript:void(0)" :class="activeMenu === 'Qualification' ? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'" class="inline-flex items-center justify-center p-4 group rounded-t-lg border-b-2">
                          <svg :class="activeMenu === 'Qualification' ? 'text-blue-600 dark:text-blue-500' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'" class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                        </svg>Qualification
                    </a>
                </li>
                <li class="me-2">
                    <a v-on:click="activeMenu = 'Contacts'" href="javascript:void(0)" :class="activeMenu === 'Contacts' ? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'" class="inline-flex items-center justify-center p-4 group rounded-t-lg border-b-2">
                        <svg :class="activeMenu === 'Contacts' ? 'text-blue-600 dark:text-blue-500' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'" class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                        </svg>Contacts
                    </a>
                </li>
                <li>
                    <a class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">Disabled</a>
                </li>
            </ul>
        </div>

        <Profile :auth="auth" v-if="activeMenu === 'Profile'" :skills="skills" :profile="profile" :user_skills="user_skills"/>
        <Password :auth="auth" v-if="activeMenu === 'Password'"/>
        <Qualification :auth="auth" :qualifications="qualifications" :universities="universities" :degrees="degrees" v-if="activeMenu === 'Qualification'"/>
        <Address :auth="auth" :address="address" :countries="countries" :cities="cities" v-if="activeMenu === 'Address'"/>

    </SeekerLayout >
</template>

<style scoped>

</style>
