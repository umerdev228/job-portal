<script setup>

import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Aside from "@/Components/Admin/Aside.vue";
import Nav from "@/Components/Admin/Nav.vue";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    notifications: {
        type: Array,
        default: [],
    },
});

</script>

<template>
    <Nav :auth="auth" :notifications="notifications"/>
    <Aside :auth="auth"/>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 bg-gray-50 dark:bg-gray-800">
            <slot/>
        </div>
    </div>
</template>

<style scoped>

</style>
