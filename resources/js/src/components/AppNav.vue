<template>
    <nav
        class="bg-white border-b border-gray-200 sm:px-4 px-2 lg:py-2 py-1 lg:z-40 z-50"
    >
        <div class="flex flex-wrap justify-between items-center">
            <div class="flex justify-start items-center">
                <button
                    class="p-2 mr-2 rounded-full cursor-pointer lg:hidden hover:bg-gray-100"
                    @click="isShowSidebar =! isShowSidebar, $emit('showSidebar', isShowSidebar)"
                >
                    <!-- menu icon -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        viewBox="0 0 448 512"
                        v-if="!isShowSidebar"
                    >
                        <path
                            d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"
                        />
                    </svg>

                    <!-- close icon -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"
                        class="w-5 h-5"
                        v-else
                    >
                        <path
                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
                        />
                    </svg>
                </button>
                <a href="#">
                    <img
                        src="@/assets/svgs/logo.svg"
                        class="max-w-[140px] lg:hidden py-0.5"
                        alt="Logo"
                    />
                </a>
            </div>
            <div class="flex items-center lg:order-2">
                <!-- Notifications -->
                <button
                    class="p-2 md:mx-1.5 mx-0.5 rounded-full border text-gray-500 border-gray-300 hover:bg-gray-100 relative"
                >
                    <!-- Bell icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] fill-current" viewBox="0 0 512 512">
                        <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480l0-83.6c0-4 1.5-7.8 4.2-10.8L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/>
                    </svg>
                    <div
                        class="w-2 aspect-square rounded-full bg-red-500 absolute right-0"
                    ></div>
                </button>

                <!-- Notifications -->
                <button
                    class="p-2 md:mx-1.5 mx-0.5 rounded-full border text-gray-500 border-gray-300 hover:bg-gray-100 relative"
                    @click="isShowNotification = !isShowNotification"
                    v-click-outside="() => (isShowNotification = false)"
                >
                    <!-- Bell icon -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"
                        class="w-5 h-5 fill-current"
                    >
                        <path
                            d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416l384 0c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8l0-18.8c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"
                        />
                    </svg>
                    <div
                        class="w-2 aspect-square rounded-full bg-red-500 absolute right-0"
                    ></div>
                </button>

                <!-- Dropdown menu -->
                <transition name="slide-up">
                    <div
                        class="overflow-hidden absolute top-full sm:right-5 right-3 z-50 md:my-4 my-2 md:max-w-sm max-w-xs text-base list-none bg-white rounded-md border shadow-md"
                        v-show="isShowNotification"
                    >
                        <div
                            class="block py-2 px-4 text-base font-medium text-center text-gray-700"
                        >
                            Notifications
                        </div>
                        <div class="border-y">
                            <a
                                href="#"
                                class="flex py-3 px-4 hover:bg-gray-100"
                                v-for="i in 5"
                                :key="i"
                            >
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-11 h-11 rounded-full overflow-hidden"
                                    >
                                        <img
                                            src="https://plus.unsplash.com/premium_photo-1688740375397-34605b6abe48?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZmVtYWxlJTIwYXZhdGFyfGVufDB8fDB8fHww"
                                            class="object-cover w-full h-full"
                                            alt="user"
                                        />
                                    </div>
                                </div>
                                <div class="pl-3 w-full">
                                    <div
                                        class="text-gray-500 font-normal line-clamp-1 text-sm mb-1"
                                    >
                                        New message from Jone Deo "Hello, what's
                                        up?" dfsdfsdfsdfsdfsdfsdfsdfsdfsdfsf sdfdfsdfsdfsdf sdfsdfsdfsdfsdfsdf sdfsdfsdfsdf
                                    </div>
                                    <div class="text-xs font-medium">
                                        1 hour ago
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a
                            href="#"
                            class="block py-2 text-md font-medium text-center text-gray-900 hover:bg-gray-100"
                        >
                            <div class="inline-flex items-center">
                                <svg
                                    aria-hidden="true"
                                    class="mr-2 w-4 h-4 text-gray-500"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                    ></path>
                                    <path
                                        fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                View all
                            </div>
                        </a>
                    </div>
                </transition>

                <!-- user menu -->
                <button
                    class="flex ml-2 mr-1 text-sm md:mr-0 justify-center items-center gap-2"
                    @click="isShowUserMenu = !isShowUserMenu"
                    v-click-outside="() => (isShowUserMenu = false)"
                >
                    <UserAvatar name="Jone Deo" class="w-9 h-9" />

                    <div class="md:block hidden">
                        <p
                            class="text-base font-medium mb-0.5 leading-none text-left"
                        >
                            Jone Deo
                        </p>
                        <p
                            class="text-xs leading-none m-0 text-left font-normal text-gray-500"
                        >
                            Root Admin
                        </p>
                    </div>
                </button>

                <!-- Dropdown menu -->
                <transition name="slide-up">
                    <div
                        class="absolute top-full right-3 z-50 md:my-4 my-2 w-60 text-base list-none bg-white divide-y border shadow-md rounded-md"
                        v-show="isShowUserMenu"
                    >
                        <div class="flex gap-3 items-center flex-col py-4 px-4">
                            <UserAvatar name="Jone Deo" class="w-16 h-16" />
                            <div>
                                <p
                                    class="block text-base mb-0 text-center font-semibold text-gray-600"
                                >
                                    Jone Deo
                                </p>
                                <p
                                    class="block text-sm text-gray-500 jext-center truncate"
                                >
                                    jone@gmail.com
                                </p>
                            </div>
                        </div>
                        <ul class="py-1 text-gray-700">
                            <li>
                                <a
                                    href="#"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100"
                                    >My profile</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100"
                                    >Change Password</a
                                >
                            </li>
                        </ul>
                        <ul class="py-1 text-gray-700">
                            <li>
                                <p
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 cursor-pointer"
                                >
                                    Sign out
                                </p>
                            </li>
                        </ul>
                    </div>
                </transition>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref } from "vue";
import UserAvatar from "./UserAvatar.vue";

const isShowNotification = ref(false);
const isShowUserMenu = ref(false);
const isShowSidebar = ref(false);
</script>
