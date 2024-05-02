<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
import {ref, watch} from 'vue';
import Multiselect from 'vue-multiselect'

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },

    jobs: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
    filters: {
        type: String,
        required: true,
        default: null,
    },
  
    category_id: {
        type: Number,
        required: true,
        default: 0,
    },
    skills: {
        type: Array,
        default: [],
    },
    skill_id: {
        type: Number,
        required: true,
        default: 0,
    },
});

let search = ref(props.filters);

const form = useForm({
    search: props.filters,
    category_id: 0,
    skill_id:0,
    // skills: [],

});

function filterJob(category_id) {
    form.category_id = category_id;
    form.post('/jobs', {
        preserveState: true,
        preserveScroll: true,
    })
}
function filterJobSkill(skill_id) {
    form.skill_id = skill_id;
    form.post('/jobs', {
        preserveState: true,
        preserveScroll: true,
    })
    
}

watch(search, value => {
    form.search = search.value
    form.get('/jobs', {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
});



const truncateDescription = (description) => {
    const words = description.split(' ');
    if (words.length > 15) {
        return words.slice(0, 15).join(' ') + '...';
    }
    return description;
};
</script>

<template>
    <Head title="Home"/>
    <FrontendLayout :auth="auth">

<form enctype="multipart/form-data"  class="max-w-lg mx-auto">
    <div class="flex">
        <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
        <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button"> Select categories <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
  </svg></button>
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
            <li v-for="category in categories" :class="form.category_id === category.id ? ' text-white' : 'bg-black'"
                class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white border border-blue-200"
                     type="text" v-on:click="filterJob(category.id)">
            {{ category.title }}
            </li>

            </ul>
        </div>
               
        <div class="relative w-full">
            <input v-model="search"
                       class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Search Jobs Title & Skill..."
                       required type="text"/>
                <button
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="submit">
                    Search
                </button>
        </div>
        
        
    </div>


            <div class="relative w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose a Skill</label>
                <multiselect v-model="form.skill_id" :class="form.skill_id === skill_id ? 'text-black' : 'bg-black'" :options="skills" multiple :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Choose Skills" label="title" track-by="id" :preselect-first="true" @click="filterJobSkill(skill.id)">
                    <template slot="selection" slot-scope="{ values, search, isOpen }">
                        <span class="multiselect__single" v-if="skills.length" v-show="!isOpen">{{ skills.length }} options selected</span>
                    </template>
                </multiselect>
            </div>
</form>








        <!-- <form class="max-w-md mx-auto">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400"
                         fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" stroke="currentColor"
                              stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"/>
                    </svg>
                </div>
                <input v-model="search"
                       class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Search Jobs..."
                       required type="text"/>
                <button
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="submit">
                    Search
                </button>
            </div>
        </form> -->
        <div
            class="flex justify-between border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 my-4 p-4">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl ">
                Jobs
            </h1>
            <!-- <input v-model="search" type="text" placeholder="search..." class="border px-2 rounded lg"> -->
        </div>


        <div class="grid grid-cols-4 md:grid-cols-4 gap-4">
            <div v-for="job in jobs.data"
                 class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <Link :href="route('jobs.show', job.id)">
                    <div class="image-container">
                         <img alt="" class="rounded-t-lg object-cover" :src="job.image"/>
                    </div>
                </Link>
                <div class="p-5">
                    <Link :href="route('jobs.show', job.id)">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{
                                job.title
                            }}</h5>
                    </Link>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        {{ truncateDescription(job.description) }}</p>
                    <Link v-if="auth.user && auth.applied_jobs.find(j => j === job.id)"
                          class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-gray-400 dark:focus:ring-blue-800"
                          disabled>
                        Applied
                    </Link>
                    <Link v-else
                          :href="route('jobs.show', job.id)"
                          class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Apply Now
                        <svg aria-hidden="true" class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                             fill="none" viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"/>
                        </svg>
                    </Link>
                </div>
            </div>

        </div>
        <nav aria-label="Page navigation example" class="mt-6">
            <ul class="inline-flex -space-x-px text-sm">
                <li>
                    <Component :is="jobs.links[0].url ? Link : 'span'" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" :class="{ 'font-bold': jobs.links[0].active, 'hover:text-white hover:font-bold': jobs.links[0].active }" :href="jobs.links[0].url" v-html="jobs.links[0].label"/>
                </li>
                 <li v-for="(link, index) in jobs.links.slice(1, -1)" :key="index">
                    <Component :is="link.url ? Link : 'span'" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"  :class="{'text-white': !link.url,  'font-bold': link.active}" :href="link.url" v-html="link.label"/>
                </li>
                <li>
                    <Component :is="jobs.links.slice(-1)[0].url ? Link : 'span'" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" :class="{ 'font-bold': jobs.links.slice(-1)[0].active, 'hover:text-white hover:font-bold': jobs.links.slice(-1)[0].active }" :href="jobs.links.slice(-1)[0].url" v-html="jobs.links.slice(-1)[0].label"/>
                 </li>
            </ul>
        </nav>
    </FrontendLayout>
</template>

<style>
.image-container {
    width: 100%;
    height: 200px; /* Adjust the height as needed */
    overflow: hidden;
    position: relative;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
