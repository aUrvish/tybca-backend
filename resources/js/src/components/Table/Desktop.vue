<template>
    <section>
        <div>
            <!-- Start coding here -->
            <div class="bg-white relative border sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between p-4">
                    <div class="w-full sm:max-w-[280px] max-w-[150px]">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                        viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2"
                                    placeholder="Search">
                            </div>
                        </form>
                    </div>

                    <div class="flex gap-4 items-center">

                        <div class="relative">
                            <button
                                class="w-full md:w-auto flex items-center justify-center py-2 px-3.5 text-sm font-medium text-gray-700 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-primary-700"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 fill-current text-gray-500"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
                                </svg>
                                Actions
                                <svg class="-mr-1 ml-1.5 w-5 h-5 text-gray-400" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div
                                class="hidden absolute right-0 top-[110%] z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow-md border">
                                <ul class="py-1 text-sm">
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100">Mass
                                            Edit</a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Delete
                                        all</a>
                                </div>
                            </div>
                        </div>

                        <div class="relative">
                            <button
                                class="w-full md:w-auto flex items-center justify-center py-2 px-3.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 fill-current text-gray-500"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M3.9 54.9C10.5 40.9 24.5 32 40 32l432 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9 320 448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z" />
                                </svg>
                                Filter
                                <svg class="-mr-1 ml-1.5 w-5 h-5 text-gray-400" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div
                                class="hidden absolute right-0 top-[110%] z-10 w-56 bg-white rounded divide-y divide-gray-100 shadow-md border p-2">
                                <div>
                                    <p class="text-[13px] mb-0.5 font-medium text-gray-500">Choose
                                        Field</p>
                                    <div class="relative">
                                        <select
                                            class="bg-gray-50 border border-gray-300 w-full text-gray-900 text-sm rounded-sm block py-1 px-2 outline-none">
                                            <option selected>User id</option>
                                            <option value="15">User name</option>
                                            <option value="20">Email</option>
                                            <option value="25">Mobile number</option>
                                            <option value="25">Join date</option>
                                            <option value="25">Performance</option>
                                            <option value="25">Status</option>
                                        </select>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-2.5 absolute top-1/2 -translate-y-1/2 right-2 fill-gray-500 pointer-events-none"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <p class="text-[13px] mb-0.5 font-medium text-gray-500">Choose Filter</p>
                                    <div class="relative">
                                        <select
                                            class="bg-gray-50 border border-gray-300 w-full text-gray-900 text-sm rounded-sm block py-1 px-2 outline-none">
                                            <option selected>Contains</option>
                                            <option value="15">Not Contains</option>
                                            <option value="20">Equals</option>
                                            <option value="25">Not Equals</option>
                                            <option value="25">Begins with</option>
                                            <option value="25">End with</option>
                                            <option value="25">Blank</option>
                                            <option value="25">Not Blank</option>
                                        </select>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-2.5 absolute top-1/2 -translate-y-1/2 right-2 fill-gray-500 pointer-events-none"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                        </svg>
                                    </div>
                                    <div class="relative w-full mt-2">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                                            <svg aria-hidden="true" class="w-4 h-4 text-gray-400" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="simple-search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm block w-full pl-8 p-1 outline-none"
                                            placeholder="Filter">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="border-y px-4 py-2">
                    <div class="flex gap-4 items-center">
                        <p class="text-sm font-medium text-gray-900">Show only:</p>
                        <div class="flex items-center">
                            <input id="inline-radio" type="radio" value="" name="inline-radio-group"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                            <label for="inline-radio" class="ms-1.5 text-sm font-medium text-gray-600">Active</label>
                        </div>
                        <div class="flex items-center">
                            <input id="inline-2-radio" type="radio" value="" name="inline-radio-group"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                            <label for="inline-2-radio"
                                class="ms-1.5 text-sm font-medium text-gray-600">Inactive</label>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs border-b uppercase">
                            <tr class="[&>*]:whitespace-nowrap">
                                <!-- <th scope="col" class="px-4 py-3 sr-only">Rank</th> -->
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded">
                                        <label class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="pr-4 pl-1 py-3">
                                    <div class="cursor-pointer flex gap-1 items-center">
                                        <p>User ID</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="max-w-1.5 fill-gray-500"
                                            viewBox="0 0 320 512">
                                            <path
                                                d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <div class="cursor-pointer flex gap-1 items-center justify-center">
                                        <p>User Name</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="max-w-1.5 fill-gray-500"
                                            viewBox="0 0 320 512">
                                            <path
                                                d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 text-center">E-Mail</th>
                                <th scope="col" class="px-4 py-3 text-center">Mobile</th>
                                <th scope="col" class="px-4 py-3">
                                    <div class="cursor-pointer flex gap-1 items-center justify-center">
                                        <p>Join Date</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="max-w-1.5 fill-gray-500"
                                            viewBox="0 0 320 512">
                                            <path
                                                d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 text-center">Performance</th>
                                <th scope="col" class="px-4 py-3 text-center">Status</th>
                                <th scope="col" class="px-4 py-3 flex justify-center">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="[&>*]:whitespace-nowrap border-b" v-for="i in max" :key="i">
                                <!-- <td class="pl-4 py-0"> -->
                                <!-- <img src="@/assets/svgs/rank1.svg" v-if="i == 1" class="w-6" alt="rank">
                                    <img src="@/assets/svgs/rank2.svg" v-if="i == 2" class="w-6" alt="rank">
                                    <img src="@/assets/svgs/rank3.svg" v-if="i == 3" class="w-6" alt="rank"> -->
                                <!-- </td> -->
                                <td class="w-4 px-4 py-3">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded">
                                        <label class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <td scope="row" class="pr-4 py-3">
                                    <div class="flex items-center gap-4">
                                        <div class="w-8 aspect-square overflow-hidden relative">
                                            <div
                                                class="absolute z-10 bg-success w-2.5 right-0 bottom-0 aspect-square rounded-full">
                                            </div>
                                            <img src="https://www.shutterstock.com/image-vector/woman-modern-icon-avatar-design-260nw-2358837033.jpg"
                                                class="w-full h-full object-cover rounded-full border" alt="avtar">
                                        </div>
                                        <p>#0001</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">Nitesh N Nageshri</td>
                                <td class="px-4 py-3 text-center">nitesh@gmail.com</td>
                                <td class="px-4 py-3 text-center">+91 85865 86969</td>
                                <td class="px-4 py-3 text-center">24 Nov 2021</td>
                                <td class="px-4 py-3 ">
                                    <div
                                        class="text-center text-success font-semibold flex justify-center items-center">

                                        12%
                                        <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 10 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4" />
                                        </svg>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <!-- <span class="text-[12px] border text-blue rounded-md border-blue py-1 px-2" >Complete</span> -->
                                    <!-- <span class="text-[12px] border text-warning rounded-md border-warning py-1 px-2" >Pending</span> -->
                                    <span
                                        class="text-[12px] border text-success rounded-md border-success py-1 px-2">Active</span>
                                </td>

                                <td class="px-4 pl-1 py-3">
                                    <div class="flex items-center justify-end gap-4">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer">
                                            <div
                                                class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue">
                                            </div>
                                        </label>
                                        <button
                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg"
                                            @click="showActionMenu($event, i)" v-click-outside="() => hideActionMenu(i)"
                                            type="button">
                                            <svg class="w-5 h-5 rotate-90" aria-hidden="true" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div class="absolute z-10 w-44 bg-white border right-10 rounded-md divide-y divide-gray-100 shadow"
                                            ref="menu" v-show="isShowActionMenu == i"
                                            :style="max - 3 < i ? { top: `${menuTop - 208}px` } : { top: `${menuTop - 108}px` }">
                                            <!-- :class="max - 3 < i ? 'bottom-full' : 'top-full'" -->
                                            <ul class="py-1 text-sm text-gray-700">
                                                <li>
                                                    <a href="#" class="block py-2 px-4 hover:bg-gray-100">Show</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block py-2 px-4 hover:bg-gray-100">Edit</a>
                                                </li>
                                            </ul>
                                            <div class="py-1">
                                                <a href="#"
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <nav class="flex justify-between items-center space-y-0 p-4" aria-label="Table navigation">
                    <div class="flex gap-2 items-center">
                        <div class="flex gap-2 items-center">
                            <p class="text-sm font-normal text-gray-500">Rows Per Page:</p>
                            <div class="relative">
                                <select
                                    class="bg-gray-50 border border-gray-300 w-14 text-gray-900 text-sm rounded-md block py-1.5 px-2 outline-none">
                                    <option selected>10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-2.5 absolute top-1/2 -translate-y-1/2 right-2 fill-gray-500 pointer-events-none"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <span class="text-sm font-normal text-gray-500">
                                <span class="font-semibold text-gray-900">1-10</span>
                                of
                                <span class="font-semibold text-gray-900">1000</span>
                            </span>
                        </div>
                    </div>
                    <Pagination />
                </nav>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import Pagination from '../Pagination.vue';
const props = defineProps({
    max: {
        default: 10,
    }
})
const isShowActionMenu = ref(null)
const menuTop = ref(0);
const menu = ref(0);

const showActionMenu = (e, index) => {
    const { top } = e.currentTarget.getBoundingClientRect()

    menuTop.value = top

    if (isShowActionMenu.value == index) {
        isShowActionMenu.value = null
        return null
    }
    isShowActionMenu.value = index
}

const hideActionMenu = (index) => {
    if (isShowActionMenu.value == index) {
        isShowActionMenu.value = null
    }
}
</script>

<style>
select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}
</style>