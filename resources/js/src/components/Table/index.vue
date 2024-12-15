<template>
    <div>
        <Universal />
    </div>
</template>

<script setup>
import Universal from './Universal.vue';

const props = defineProps({
    config : {
        require : true
    }
});

console.log(props.config);
</script>