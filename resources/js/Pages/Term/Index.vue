<script setup>
import {Head} from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
   


});

</script>

<template>
    <Head title="Home"/>
    <FrontendLayout :auth="auth">
        <div
            class="flex justify-center border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 my-4 p-4">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl ">
                Trem & Condition
            </h1>
        </div>
        <p class="mb-3 text-center text-black-500 dark:text-black-400">
            Welcome to Jobs-hub's Terms and Conditions. By accessing our platform, you agree to comply with these terms. Users are responsible for their account security and content posted. Jobs-hub provides content "as is" without warranties. We are not liable for any damages. Users indemnify Jobs-hub from claims. Terms may change; users are advised to review them. These terms are governed by [your jurisdiction]'s laws. For questions, contact us. Thank you for choosing Jobs-hub.
        </p>


    </FrontendLayout>
</template>

<style>

</style>
