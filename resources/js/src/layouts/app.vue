<script setup>
import AppNav from "@/components/AppNav.vue";
import AppSidebar from "@/components/AppSidebar.vue";
import { RouterView } from "vue-router";
import { ref } from "vue";

const isShowSidebar = ref(false);
</script>

<template>
    <div class="antialiased bg-gray-50 h-full">
        <!-- navbar -->
        <AppNav
            class="fixed left-0 right-0 top-0"
            @showSidebar="(value) => (isShowSidebar = value)"
        />

        <!-- Sidebar -->
        <AppSidebar :isShow="isShowSidebar" />

        <main class="p-4 lg:ml-64 h-auto pt-20">
            <RouterView />
        </main>
    </div>
</template>
