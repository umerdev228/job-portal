<script setup>
import {Link, Head} from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Inertia } from '@inertiajs/inertia';


const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    categories: {
        type: Array,
        default: [],
    }
});
 const toggleStatus = (categoryId,newValue)=>{
    Inertia.put(route('admin.categories.updateCategories',categoryId),{
        'status':newValue
    });
 };


</script>

<template>
    <Head title="Categories | Jobs Hub"/>
    <AdminLayout :auth="auth">
        <div class="flex justify-between">
            <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">
                Categories
            </h1>
            <Link :href="route('admin.categories.create')"
                  class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center h-10 p-2">
                Create
            </Link>
        </div>

        <nav aria-label="Breadcrumb" class="flex my-4">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <Link
                        :href="route('admin.dashboard')"
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
                        <Link
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                            href="">Categories
                        </Link>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3" scope="col">
                            Name
                        </th>
                       
                        <th class="px-6 py-3" scope="col">
                            is_feature
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Status
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in categories.data" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                            {{ category.title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ category.is_feature }}
                        </td>
                        <td class="px-6 py-4">
                            <label  class="inline-flex items-center cursor-pointer" >
                                <input v-model="category.status"  type="checkbox" class="sr-only peer" v-on:change="toggleStatus(category.id,category.status)">
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>
                        </td>  
                        <td class="px-6 py-4 text-right flex">
                            <Link class="font-medium text-blue-600 dark:text-blue-500 hover:underline" :href="route('admin.categories.edit',category.id)">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd"/>
                                </svg>
                            </Link>
                            <Link class="font-medium text-blue-600 dark:text-blue-500 hover:underline"  :href="route('admin.categories.destroy',category.id)" method="delete">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                </svg>
                            </Link>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-6 text-white">
        <Component
	     :is="link.url ? Link : 'span'"

          v-for="link in categories.links" 
          :href="link.url" 
          v-html="link.label" 
          class="px-1" 
          :class="{'text-gray-500': !link.url,'font-bold':link.active}"
        />
          
        </div>

        </div>

    </AdminLayout>
</template>

<style scoped>

</style>
