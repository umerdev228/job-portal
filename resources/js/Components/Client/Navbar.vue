<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
});


</script>

<template>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <Link :href="route('home')" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img alt="Jobs-Hub" class="h-10 " src="/images/logo/logo.png"/>
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Jobs-hub</span>
                <!-- <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ auth.app_name }}</span> -->
            </Link>


            <div v-if="auth.user" class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

                <button id="user-menu-button"
                        aria-expanded="false"
                        class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        data-dropdown-placement="bottom" data-dropdown-toggle="user-dropdown"
                        type="button">
                    <span class="sr-only">Open user menu</span>
                    <img :src="'/storage'+(auth.user.image.replace('public',''))"
                         alt="user photo"
                         class="w-8 h-8 rounded-full">
                </button>
                <!-- Dropdown menu -->
                <div
                    id="user-dropdown"
                    class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">{{ auth.user.first_name }}</span>
                        <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{
                                auth.user.email
                            }}</span>
                    </div>
                    <ul aria-labelledby="user-menu-button" class="py-2">
                        <li>
                            <Link
                                :href="'/' + auth.user.role + '/dashboard'"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Dashboard
                            </Link>
                        </li>
                        <li>
                            <Link
                                :href="'/' + auth.user.role + '/profile'"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Profile
                            </Link>
                        </li>
                        <li>
                            <Link
                                :href="route('logout')"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                method="post">
                                Sign out
                            </Link>
                        </li>
                    </ul>
                </div>
                <button aria-controls="navbar-user" aria-expanded="false"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        data-collapse-toggle="navbar-user" type="button">
                    <span class="sr-only">Open main menu</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="none" viewBox="0 0 17 14"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1h15M1 7h15M1 13h15" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"/>
                    </svg>
                </button>
            </div>
            <div v-else class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <Link :href="route('login')"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                    Login
                </Link>
                <Link :href="route('register')"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                    Register
                </Link>
            </div>
            <div id="navbar-user" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <Link
                            :class="{'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 ': route().current('home')}"
                            :href="route('home')"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                            Home
                        </Link>
                    </li>
                    <li>
                        <Link
                            :class="{'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 ': route().current('jobs.index')}"
                            :href="route('jobs.index')"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                            Jobs
                        </Link>
                    </li>
                    <li>
                        <Link
                            :class="{' block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500': route().current('talents.index')}"
                            :href="route('talents.index')"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                            Talent
                        </Link>
                    </li>
                    <li>
                        <Link
                            :class="{' block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 ': route().current('about.index')}"
                            :href="route('about.index')"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                            About
                        </Link>
                    </li>
                    <li>
                        <Link
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            href="#">
                            Services
                        </Link>
                    </li>
                    <li>
                        <Link
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            href="#">
                            Contact
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</template>

<style scoped>

</style>
