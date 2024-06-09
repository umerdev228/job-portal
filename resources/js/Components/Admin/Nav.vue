<script setup>
import {ref} from "vue";
import { router } from '@inertiajs/vue3'
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    auth: {
        type: Object,
        default: {},
    },
    notifications: {
        type: Array,
        default: []
    },

});
const showPopup = ref(false);
console.log(props.notifications)

const togglePopup = () => {
    showPopup.value = !showPopup.value;
    if (showPopup.value) {
        router.post(route("admin.notifications.markAllAsRead"));
    }
};
const viewNotificationDetail = (notificationId) => {
    console.log(notificationId)
    router.get(route('admin.notification.show', notificationId));
};
</script>

<template>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button
                        aria-controls="logo-sidebar"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        data-drawer-target="logo-sidebar"
                        data-drawer-toggle="logo-sidebar"
                        type="button"
                    >
                        <span class="sr-only">Open sidebar</span>
                        <svg
                            aria-hidden="true"
                            class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                clip-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                                fill-rule="evenodd"
                            ></path>
                        </svg>
                    </button>
                    <a :href="route('home')" class="flex ms-2 md:me-24">
                        <img
                            alt=" Logo"
                            class="h-10 me-3"
                            src="/images/logo/logo.png"
                        />
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"
                        >Jobs-hub</span
                        >
                        <!-- <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"
                            >{{ auth.app_name }}</span
                        > -->
                    </a>
                </div>

                <div class="flex items-center">
                    <div class="relative">
                        <svg
                            aria-hidden="true"
                            class="w-6 h-6 text-gray-800 dark:text-white cursor-pointer"
                            fill="none"
                            height="24"
                            viewBox="0 0 24 24"
                            width="24"
                            xmlns="http://www.w3.org/2000/svg"
                            v-on:click="togglePopup"
                        >
                            <path
                                d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.292-.538 1.292H5.538C5 18 5 17.301 5 16.708c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365ZM8.733 18c.094.852.306 1.54.944 2.112a3.48 3.48 0 0 0 4.646 0c.638-.572 1.236-1.26 1.33-2.112h-6.92Z"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                            />
                        </svg>

                        <div
                            class="px-1 bg-teal-500 rounded-full text-center text-white text-xs absolute -top-3 -end-2"
                        >
                            {{
                                notifications.filter(
                                    (notification) =>
                                        notification.status === "unread"
                                ).length
                            }}
                            <div
                                class="absolute top-0 start-0 rounded-full -z-10 animate-ping bg-teal-200 w-full h-full"
                            ></div>
                        </div>

                        <div
                            v-if="showPopup"
                            class="absolute right-0 bg-gray-800 border border-gray-100 z-50 mt-2 py-2 w-[400px] max-h-[400px] overflow-y-auto rounded-md shadow-xl scrollbar-thin scrollbar-thumb-rounded-full scrollbar-track-rounded-full scrollbar-thumb-gray-700 scrollbar-track-gray-300"
                        >
                            <!-- Notifications Heading -->
                            <div class="px-4 py-2 text-white text-lg font-bold">
                                Notifications
                            </div>
                            <button
                                aria-label="close modal"
                                class="text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-md cursor-pointer absolute top-2 right-2"
                                role="button"
                            >
                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M6 18L18 6M6 6l12 12"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                    />
                                </svg>
                            </button>
                            <hr/>

                            <!-- Loop through notifications -->
                            <div
                                v-for="(notification, index) in notifications"
                                :key="index"
                                class="flex items-center px-4 py-2 text-gray-800 dark:text-white bg-gray-800 hover:bg-gray-700 border-b border-white border-opacity-50 cursor-pointer"
                                v-on:click="viewNotificationDetail(notification.id)"
                            >
                                <span
                                    v-if="notification.status === 'read'"
                                    class="w-2 h-2 rounded-full bg-blue-500 me-2"
                                ></span>
                                {{ notification.message }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center ms-3">
                        <div>
                            <button
                                aria-expanded="false"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                data-dropdown-toggle="dropdown-user"
                                type="button"
                            >
                                <span class="sr-only">Open user menu</span>
                                <img
                                    :src="
                                        '/storage/' +
                                        auth.user.image.replace('public', '')
                                    "
                                    alt="user photo"
                                    class="w-8 h-8 rounded-full"
                                />
                            </button>
                        </div>
                        <div
                            id="dropdown-user"
                            class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        >
                            <div class="px-4 py-3" role="none">
                                <p
                                    class="text-sm text-gray-900 dark:text-white"
                                    role="none"
                                >
                                    {{ auth.user.first_name }}
                                </p>
                                <p
                                    class="text-sm font-medium text-gray-900 truncate dark:text-gray-300"
                                    role="none"
                                >
                                    {{ auth.user.email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <Link
                                        :href="route('admin.dashboard')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem"
                                    >Dashboard
                                    </Link
                                    >
                                </li>
                                <li>
                                    <Link
                                        :href="route('admin.profile.index')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem"
                                    >Profile
                                    </Link
                                    >
                                </li>
                                <li>
                                    <Link
                                        :href="route('logout')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        method="post"
                                        role="menuitem"
                                    >Logout
                                    </Link
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped>
/* Designing for scroll-bar */
::-webkit-scrollbar {
    width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
    background: gainsboro;
    border-radius: 5px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: gray;
    border-radius: 5px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
