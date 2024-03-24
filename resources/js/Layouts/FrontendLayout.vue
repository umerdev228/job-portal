<script setup>
import Navbar from "@/Components/Client/Navbar.vue";
import {onMounted} from 'vue'
import {initFlowbite} from 'flowbite'
import Footer from "@/Components/Client/Footer.vue";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
});
</script>

<template>
    <Navbar :auth="auth"/>
    <div class="p-4">
        <div
            class="p-4">
            <slot/>
        </div>
    </div>
    <Footer/>
</template>
