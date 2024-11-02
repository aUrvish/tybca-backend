import "./bootstrap";
import { createApp } from "vue";
import App from "./src/App.vue";
import router from "@/router/index.js";
import vClickOutside from "click-outside-vue3";

const app = createApp(App);
app.use(router);
app.use(vClickOutside);
app.mount("#app");
