<template>
    <div class="antialiased h-full">
        <!-- navbar -->
        <AppNav
            class="fixed left-0 right-0 top-0"
            @showSidebar="(value) => (isShowSidebar = value, isMiniSidebar = false)"
        />

        <!-- Sidebar -->
        <AppSidebar
            :isShow="isShowSidebar"
            :isMini="isMiniSidebar"
            @changeSidebarSize="(value) => (isMiniSidebar = value)"
        />

        <main
            class="md:p-4 p-3 h-full md:pt-20 pt-16"
            :class="isMiniSidebar ? 'lg:ml-16' : 'lg:ml-64'"
        >
            <div class="container mx-auto" >
                <RouterView />
            </div>
        </main>
    </div>
</template>

<script setup>
import AppNav from "@/components/AppNav.vue";
import AppSidebar from "@/components/AppSidebar.vue";
import { RouterView } from "vue-router";
import { ref } from "vue";

const isShowSidebar = ref(false);
const isMiniSidebar = ref(false);
</script>
