<script setup>
import {Head, Link} from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },

    users: {
        type: Array,
        required: true,
    },

});


</script>

<template>
    <Head title="Home"/>
    <FrontendLayout :auth="auth">
        <div
            class="flex justify-between border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 my-4 p-4">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl ">
                users
            </h1>
        </div>
        <div class="grid grid-cols-4 md:grid-cols-4 gap-4">
            <div v-for="user in users.data"
                 class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <Link >
                    <img :src="user.image" alt="" class="rounded-t-lg"/>
                </Link>
                <div class="p-5">
                    <Link >
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ user.first_name }} {{ user.last_name }}</h5>
                    </Link>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        Email : {{ user.email }}</p>
                   
                </div>
            </div>

        </div>

        <!-- Pagination Section -->
        <div class="mt-6 text-black">
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="link in users.links"
                :class="{'text-gray-500': !link.url, 'font-bold': link.active}"
                :href="link.url"
                class="px-1"
                v-html="link.label"
            />
        </div>


    </FrontendLayout>
</template>

<style>

</style>
