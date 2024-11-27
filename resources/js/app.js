import "./bootstrap";
import 'floating-vue/dist/style.css'
import { createApp } from "vue";
import App from "./src/App.vue";
import router from "@/router/index.js";
import vClickOutside from "click-outside-vue3";
import FloatingVue from 'floating-vue'

const app = createApp(App);
app.use(router);
app.use(vClickOutside);
app.use(FloatingVue);
app.mount("#app");
