<template>
    <section>
        <div>
            <!-- Start coding here -->
            <div class="bg-white relative border sm:rounded-lg rounded-md overflow-hidden">
                <div class="flex flex-col px-2 py-3 gap-2">
                    <div class="w-full flex gap-2 items-center">
                        <form class="flex items-center w-full">
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
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md block w-full pl-10 p-2"
                                    placeholder="Search">
                            </div>
                        </form>
                        <div class="relative">
                            <button
                                class="w-full md:w-auto flex items-center justify-center py-2 px-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-primary-700 whitespace-nowrap"
                                type="button">
                                Sort By
                                <svg class="-mr-1 ml-1.5 w-5 h-5 text-gray-400" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div
                                class="hidden absolute right-0 top-[110%] z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow-md border p-4">
                                <div>
                                    <ul class="space-y-2 text-sm">
                                        <li class="flex items-center">
                                            <input id="apple" type="checkbox" value=""
                                                class="w-3.5 h-3.5 bg-gray-100 border-gray-300 rounded text-primary-600">
                                            <label for="apple" class="ml-2 text-sm font-medium text-gray-900">Newest
                                                Records</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="fitbit" type="checkbox" value=""
                                                class="w-3.5 h-3.5 bg-gray-100 border-gray-300 rounded text-primary-600">
                                            <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">Oldest
                                                Records</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 items-center justify-start">

                        <div class="relative">
                            <button
                                class="w-full md:w-auto flex items-center justify-center py-2 px-2.5 text-sm font-medium text-gray-700 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-primary-700"
                                type="button">
                                Actions
                                <svg class="-mr-1 ml-1.5 w-5 h-5 text-gray-400" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div
                                class="hidden absolute left-0 top-[110%] z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow-md border">
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
                                class="w-full md:w-auto flex items-center justify-center py-2 px-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-primary-700"
                                type="button">
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
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
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
                <div class="flex flex-col gap-2 px-2 py-4">
                    <div class="px-2 border rounded-md" v-for="i in 5">
                        <div class="flex justify-between items-center gap-2 py-2 border-b">
                            <div>
                                <p class="text-[12px] text-gray-600 mb-1 uppercase">User Id</p>
                                <div class="flex gap-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded">
                                        <label class="sr-only">checkbox</label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 aspect-square overflow-hidden relative">
                                            <div
                                                class="absolute z-10 bg-success w-2.5 right-0 bottom-0 aspect-square rounded-full">
                                            </div>
                                            <img src="https://www.shutterstock.com/image-vector/woman-modern-icon-avatar-design-260nw-2358837033.jpg"
                                                class="w-full h-full object-cover rounded-full border" alt="avtar">
                                        </div>
                                        <p class="text-sm">#0001</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="text-[12px] text-gray-600 text-right mb-1 uppercase">Action</p>
                                <div class="flex items-center justify-end gap-2 relative">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer">
                                        <div
                                            class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue">
                                        </div>
                                    </label>
                                    <button
                                        class="inline-flex items-center py-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg"
                                        @click="showActionMenu($event, i)" v-click-outside="() => hideActionMenu(i)"
                                        type="button">
                                        <svg class="w-5 h-5 rotate-90" aria-hidden="true" fill="currentColor"
                                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div class="hidden absolute z-10 w-44 bg-white border top-0 right-6 rounded-md divide-y divide-gray-100 shadow">
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
                            </div>
                        </div>
                        <div class="flex justify-between items-center gap-4 py-2 border-b">
                            <div>
                                <p class="text-[12px] text-gray-600 mb-1 uppercase">Username</p>
                                <p class="text-sm text-gray-700">Nitesh N Nageshri</p>
                            </div>
                            <div>
                                <p class="text-[12px] text-gray-600 text-right mb-1 uppercase">Email</p>
                                <p class="text-sm text-gray-700 text-right">nitesh@gmail.com</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center gap-4 py-2 border-b">
                            <div>
                                <p class="text-[12px] text-gray-600 mb-1 uppercase">Mobile</p>
                                <p class="text-sm text-gray-700">Nitesh N Nageshri</p>
                            </div>
                            <div>
                                <p class="text-[12px] text-gray-600 text-right mb-1 uppercase">Join Date</p>
                                <p class="text-sm text-gray-700 text-right">24 Nov 2021</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center gap-4 py-2">
                            <div>
                                <p class="text-[12px] text-gray-600 mb-1 uppercase">Mobile</p>
                                <div
                                    class="text-center text-green-600 font-semibold text-sm flex justify-center items-center">
                                    12%
                                    <svg class="w-2.5 h-2.5 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-[12px] text-gray-600 text-right mb-1 uppercase">Join Date</p>
                                <div class="flex justify-end" >    
                                    <span class="text-[12px] border text-green-600 rounded-md border-green-600 py-0.5 px-2">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="flex justify-between items-center space-y-0 p-4" aria-label="Table navigation">
                    <div class="flex gap-2 items-center">
                        <div>
                            Showing
                            <span class="text-sm font-normal text-gray-500">
                                <span class="font-semibold text-gray-900">1-10</span>
                                of
                                <span class="font-semibold text-gray-900">1000</span>
                            </span>
                        </div>
                    </div>
                    <!-- <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <a href="#"
                                class="flex items-center justify-center gap-1 h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Prev</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center gap-1 h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                <span>Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul> -->
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