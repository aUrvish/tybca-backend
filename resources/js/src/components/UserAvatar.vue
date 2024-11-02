<template>
    <div>
        <img
            :src="imageSource"
            class="rounded-full block object-cover h-full w-full"
            :alt="name"
        />
    </div>
</template>

<script setup>
import { computed } from "vue";

// Define props
const props = defineProps({
    name: {
        type: String,
        default: "?",
    },
    size: {
        type: Number,
        default: 50,
    },
    url: {
        type: String,
        default: null,
    },
});

// Computed property for initials
const initials = computed(() => {
    const nameSplit = props.name.trim().toUpperCase().split(" ");
    if (nameSplit.length === 1) {
        return nameSplit[0].charAt(0);
    } else {
        return nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
    }
});

// Computed property for color based on initials
const color = computed(() => {
    const colours = [
        "#1abc9c",
        "#2ecc71",
        "#3498db",
        "#9b59b6",
        "#34495e",
        "#16a085",
        "#27ae60",
        "#2980b9",
        "#8e44ad",
        "#2c3e50",
        "#f1c40f",
        "#e67e22",
        "#e74c3c",
        "#878787",
        "#95a5a6",
        "#f39c12",
        "#d35400",
        "#c0392b",
        "#bdc3c7",
        "#7f8c8d",
    ];
    const charIndex =
        initials.value === "?" ? 72 : initials.value.charCodeAt(0) - 64;
    return colours[charIndex % colours.length];
});

// Function to generate avatar as data URL
const avatarDataUrl = computed(() => {
    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");
    const pixelSize = props.size * (window.devicePixelRatio || 1);

    canvas.width = pixelSize;
    canvas.height = pixelSize;
    context.fillStyle = color.value;
    context.fillRect(0, 0, canvas.width, canvas.height);

    context.font = `${Math.round((pixelSize - 10) / 2)}px Arial`;
    context.textAlign = "center";
    context.fillStyle = "#FFF";
    context.fillText(initials.value, canvas.width / 2, canvas.height / 1.5);

    const dataUrl = canvas.toDataURL();
    canvas.remove();
    return dataUrl;
});

// Computed property to determine image source
const imageSource = computed(() => {
    return props.url ? props.url : avatarDataUrl.value;
});
</script>
