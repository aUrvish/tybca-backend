<template>
    <aside
        class="fixed top-0 left-0 lg:z-50 z-40 h-screen lg:pt-0 pt-14 transition-all bg-[#1a2e44] lg:translate-x-0 dark:bg-gray-800 dark:border-gray-700 -translate-x-full"
        :class="isMiniSidebar ? 'w-16' : 'w-64'"
    >
        <!-- :class="isShow ? 'translate-x-0' : '-translate-x-full'" -->
        <div
            class="space-y-2 hidden lg:block"
            :class="isMiniSidebar ? 'px-3 py-1' : 'px-4 py-2'"
        >
            <a href="#">
                <img
                    src="@/assets/svgs/logo-light.svg"
                    class="max-w-[120px] md:max-w-[165px] py-1.5 md:pt-2 md:pb-0"
                    alt="Logo"
                    v-if="!isMiniSidebar"
                />
                <img
                    src="@/assets/svgs/logo-mini.svg"
                    class="max-w-[40px] py-1.5 md:pt-2 md:pb-0"
                    alt="Logo"
                    v-else
                />
            </a>
        </div>
        <div
            class="overflow-y-auto py-5 px-3 h-full bg-transparent dark:bg-gray-800"
        >
            <ul class="space-y-2">
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-base font-medium text-white rounded-md hover:bg-[#38445e] group"
                        :class="isMiniSidebar ? 'justify-center' : ''"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 group-hover:text-white text-gray-400 transition duration-75"
                            fill="currentColor"
                            height="16"
                            width="18"
                            viewBox="0 0 576 512"
                        >
                            <path
                                d="M304 240V16.6c0-9 7-16.6 16-16.6C443.7 0 544 100.3 544 224c0 9-7.6 16-16.6 16H304zM32 272C32 150.7 122.1 50.3 239 34.3c9.2-1.3 17 6.1 17 15.4V288L412.5 444.5c6.7 6.7 6.2 17.7-1.5 23.1C371.8 495.6 323.8 512 272 512C139.5 512 32 404.6 32 272zm526.4 16c9.3 0 16.6 7.8 15.4 17c-7.7 55.9-34.6 105.6-73.9 142.3c-6 5.6-15.4 5.2-21.2-.7L320 288H558.4z"
                            />
                        </svg>
                        <span
                            class="ml-3.5 group-hover:text-white text-gray-400 font-normal"
                            v-if="!isMiniSidebar"
                            >Overview</span
                        >
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-base font-medium text-white rounded-md hover:bg-[#38445e] group"
                        :class="isMiniSidebar ? 'justify-center' : ''"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            class="w-5 h-5 group-hover:text-white text-gray-400 transition duration-75"
                            fill="currentColor"
                        >
                            <path
                                d="M418.4 157.9c35.3-8.3 61.6-40 61.6-77.9c0-44.2-35.8-80-80-80c-43.4 0-78.7 34.5-80 77.5L136.2 151.1C121.7 136.8 101.9 128 80 128c-44.2 0-80 35.8-80 80s35.8 80 80 80c12.2 0 23.8-2.7 34.1-7.6L259.7 407.8c-2.4 7.6-3.7 15.8-3.7 24.2c0 44.2 35.8 80 80 80s80-35.8 80-80c0-27.7-14-52.1-35.4-66.4l37.8-207.7zM156.3 232.2c2.2-6.9 3.5-14.2 3.7-21.7l183.8-73.5c3.6 3.5 7.4 6.7 11.6 9.5L317.6 354.1c-5.5 1.3-10.8 3.1-15.8 5.5L156.3 232.2z"
                            />
                        </svg>
                        <span
                            class="ml-3.5 group-hover:text-white text-gray-400 font-normal"
                            v-if="!isMiniSidebar"
                            >Tenants</span
                        >
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-base font-medium text-white rounded-md hover:bg-[#38445e] group"
                        :class="isMiniSidebar ? 'justify-center' : ''"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            class="w-5 h-5 text-gray-400 group-hover:text-white transition duration-75"
                            fill="currentColor"
                        >
                            <path
                                d="M320 96L192 96 144.6 24.9C137.5 14.2 145.1 0 157.9 0L354.1 0c12.8 0 20.4 14.2 13.3 24.9L320 96zM192 128l128 0c3.8 2.5 8.1 5.3 13 8.4C389.7 172.7 512 250.9 512 416c0 53-43 96-96 96L96 512c-53 0-96-43-96-96C0 250.9 122.3 172.7 179 136.4c0 0 0 0 0 0s0 0 0 0c4.8-3.1 9.2-5.9 13-8.4zm84 88c0-11-9-20-20-20s-20 9-20 20l0 14c-7.6 1.7-15.2 4.4-22.2 8.5c-13.9 8.3-25.9 22.8-25.8 43.9c.1 20.3 12 33.1 24.7 40.7c11 6.6 24.7 10.8 35.6 14l1.7 .5c12.6 3.8 21.8 6.8 28 10.7c5.1 3.2 5.8 5.4 5.9 8.2c.1 5-1.8 8-5.9 10.5c-5 3.1-12.9 5-21.4 4.7c-11.1-.4-21.5-3.9-35.1-8.5c-2.3-.8-4.7-1.6-7.2-2.4c-10.5-3.5-21.8 2.2-25.3 12.6s2.2 21.8 12.6 25.3c1.9 .6 4 1.3 6.1 2.1c0 0 0 0 0 0s0 0 0 0c8.3 2.9 17.9 6.2 28.2 8.4l0 14.6c0 11 9 20 20 20s20-9 20-20l0-13.8c8-1.7 16-4.5 23.2-9c14.3-8.9 25.1-24.1 24.8-45c-.3-20.3-11.7-33.4-24.6-41.6c-11.5-7.2-25.9-11.6-37.1-15c0 0 0 0 0 0l-.7-.2c-12.8-3.9-21.9-6.7-28.3-10.5c-5.2-3.1-5.3-4.9-5.3-6.7c0-3.7 1.4-6.5 6.2-9.3c5.4-3.2 13.6-5.1 21.5-5c9.6 .1 20.2 2.2 31.2 5.2c10.7 2.8 21.6-3.5 24.5-14.2s-3.5-21.6-14.2-24.5c-6.5-1.7-13.7-3.4-21.1-4.7l0-13.9z"
                            />
                        </svg>
                        <span
                            class="ml-3.5 group-hover:text-white text-gray-400 font-normal"
                            v-if="!isMiniSidebar"
                            >Billings</span
                        >
                    </a>
                </li>
            </ul>
            <ul class="space-y-2 mt-2 border-t border-[#38445e] pt-2">
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-base font-medium text-white rounded-md hover:bg-[#38445e] group"
                        :class="isMiniSidebar ? 'justify-center' : ''"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"
                            class="w-5 h-5 text-gray-400 group-hover:text-white transition duration-75"
                            fill="currentColor"
                        >
                            <path
                                d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l288 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32L384 0 96 0zm0 384l256 0 0 64L96 448c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16zm16 48l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"
                            />
                        </svg>
                        <span
                            class="ml-3.5 group-hover:text-white text-gray-400 font-normal"
                            v-if="!isMiniSidebar"
                            >Reports</span
                        >
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-base font-medium text-white rounded-md hover:bg-[#38445e] group"
                        :class="isMiniSidebar ? 'justify-center' : ''"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            class="w-5 h-5 text-gray-400 group-hover:text-white transition duration-75"
                            fill="currentColor"
                        >
                            <path
                                d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"
                            />
                        </svg>
                        <span
                            class="ml-3.5 group-hover:text-white text-gray-400 font-normal"
                            v-if="!isMiniSidebar"
                            >Settings</span
                        >
                    </a>
                </li>
            </ul>
        </div>
        <button
            @click="
                (isMiniSidebar = !isMiniSidebar),
                    $emit('changeSidebarSize', isMiniSidebar)
            "
            class="absolute top-0 z-99 p-4 cursor-pointer text-white left-full"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                viewBox="0 0 512 512"
            >
                <path
                    d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM64 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L96 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"
                />
            </svg>
        </button>
    </aside>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
    isShow: {
        default: false,
    },
    isMini: {
        default: false,
    },
});

const isMiniSidebar = ref(props.isMini);
</script>

<style scoped>
.router-link-exact-active {
    @apply bg-[#38445e] text-white border-l-[3px];
}

.router-link-exact-active svg {
    @apply fill-white;
}
</style>
