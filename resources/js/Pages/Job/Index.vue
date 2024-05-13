<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
import {ref, watch} from 'vue';
import Multiselect from 'vue-multiselect';

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

    chosen_category: {
        type: Number,
        required: true,
        default: 0,
    },
    skills: {
        type: Array,
        default: [],
    },
    chosen_skills: {
        type: Array,
        required: true,
        default: [],
    },
});

let search = ref(props.filters);
let chosen_skills = ref(props.chosen_skills);
let chosen_category = ref(props.chosen_category);

const form = useForm({
    search: props.filters,
    chosen_category: 0,
    chosen_skills: [],
});

watch(search, value => {
    form.search = search.value
    form.post('/jobs', {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
});
watch(chosen_skills, value => {
    form.chosen_skills = value
    form.post('/jobs', {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
});

watch(chosen_category, value => {
    console.log(chosen_category)
    form.chosen_category = value
    form.post('/jobs', {
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

        <form class="mx-auto" enctype="multipart/form-data">
            <div class="flex">
                <label class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white" for="search-dropdown">Your
                    Email</label>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="countries">Select an
                    option</label>
                <select id="countries" v-model="chosen_category"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 mx-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="0">Choose a category</option>
                    <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                </select>

                <div class="relative ">
                    <input v-model="search"
                           class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Search Jobs Title & Skill..."
                           required type="text"/>
                </div>
                <div class="relative">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose a Skill</label>
                    <multiselect v-model="chosen_skills" :clear-on-select="false" :close-on-select="false"
                                 :options="skills" :preselect-first="false"
                                 :preserve-search="true" label="title" multiple placeholder="Choose Skills"
                                 track-by="id">
                        <template slot="selection" slot-scope="{ values, search, isOpen }">
                            <span v-if="skills.length" v-show="!isOpen" class="multiselect__single">{{ skills.length }} options selected</span>
                        </template>
                    </multiselect>
                </div>

            </div>


        </form>
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
                        <img :src="'/storage/'+ (job.image.replace('public/','')) " alt="" class="rounded-t-lg object-cover"/>
                    </div>
                </Link>
                <div class="p-5">
                    <Link :href="route('jobs.show', job.id)">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{job.title}}</h5>
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

         <!-- Apply Pagination  -->
        <nav aria-label="Page navigation example" class="mt-6">
            <ul class="inline-flex -space-x-px text-sm">
                <li>
                    <Component :is="jobs.links[0].url ? Link : 'span'"
                               :class="{ 'font-bold': jobs.links[0].active, 'hover:text-white hover:font-bold': jobs.links[0].active }"
                               :href="jobs.links[0].url"
                               class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                               v-html="jobs.links[0].label"/>
                </li>
                <li v-for="(link, index) in jobs.links.slice(1, -1)" :key="index">
                    <Component :is="link.url ? Link : 'span'"
                               :class="{'text-white': !link.url,  'font-bold': link.active}"
                               :href="link.url"
                               class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                               v-html="link.label"/>
                </li>
                <li>
                    <Component :is="jobs.links.slice(-1)[0].url ? Link : 'span'"
                               :class="{ 'font-bold': jobs.links.slice(-1)[0].active, 'hover:text-white hover:font-bold': jobs.links.slice(-1)[0].active }"
                               :href="jobs.links.slice(-1)[0].url"
                               class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                               v-html="jobs.links.slice(-1)[0].label"/>
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


/* Designing for scroll-bar */
::-webkit-scrollbar {
            width: 8px;
        }
     
        /* Track */
        ::-webkit-scrollbar-track {
            background: gainsboro;
            border-radius: 8cqmax;
        }
     
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background:rgb(202, 194, 194);
            border-radius: 8px;
        }
     
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
</style>
