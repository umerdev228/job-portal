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

const truncateabout = (about) => {
    const words = about.split(' ');
    if (words.length > 10) {
        return words.slice(0, 10).join(' ') + '...';
    }
    return about;
};


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
        <Link :href="route('talents.show', { user})">
            <img :src="user.image" alt="" class="rounded-t-lg"/>
        </Link>
        <div class="p-5">
            <Link :href="route('talents.show', { user})">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ user.first_name }} {{ user.last_name }}</h5>
            </Link>
            
                <template v-for="skill in user.seeker.skills">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium me-2 mb-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                        {{ skill.title }},
                    </span>
                </template>
             <p class="mb-2 text-2sm  tracking-tight text-gray-900 dark:text-white" > {{truncateabout(user.seeker.about) }}</p>
        </div>
    </div>
</div>

        <!-- Pagination Section -->
        <nav aria-label="Page navigation example" class="mt-6">
    <ul class="inline-flex -space-x-px text-sm">
        <li>
            <Component :is="users.links[0].url ? 'Link' : 'span'"
                       :class="{ 'font-bold': users.links[0].active, 'hover:text-white hover:font-bold': users.links[0].active }"
                       :href="users.links[0].url"
                       class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                       v-html="users.links[0].label"/>
        </li>
        <li v-for="(link, index) in users.links.slice(1, -1)" :key="index">
            <Component :is="link.url ? 'Link' : 'span'"
                       :class="{'text-white': !link.url,  'font-bold': link.active}"
                       :href="link.url"
                       class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                       v-html="link.label"/>
        </li>
        <li>
            <Component :is="users.links.slice(-1)[0].url ? 'Link' : 'span'"
                       :class="{ 'font-bold': users.links.slice(-1)[0].active, 'hover:text-white hover:font-bold': users.links.slice(-1)[0].active }"
                       :href="users.links.slice(-1)[0].url"
                       class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                       v-html="users.links.slice(-1)[0].label"/>
        </li>
    </ul>
</nav>



    </FrontendLayout>
</template>

<style>

</style>
