<template>
    <div>
        <Desktop class="md:block hidden" />
        <Mobile class="md:hidden block" />
    </div>
</template>

<script setup>
import Desktop from './Desktop.vue';
import Mobile from './Mobile.vue';
</script>