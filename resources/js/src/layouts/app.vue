<template>
    <div class="antialiased bg-gray-100 h-full">
        <!-- navbar -->
        <AppNav
            class="fixed left-0 right-0 top-0"
            @showSidebar="(value) => (isShowSidebar = value)"
        />

        <!-- Sidebar -->
        <AppSidebar
            :isShow="isShowSidebar"
            :isMini="isMiniSidebar"
            @changeSidebarSize="(value) => (isMiniSidebar = value)"
        />

        <main
            class="p-4 h-auto pt-20"
            :class="isMiniSidebar ? 'lg:ml-16' : 'lg:ml-64'"
        >
            <RouterView />
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
