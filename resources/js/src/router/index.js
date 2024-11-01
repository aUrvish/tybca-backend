import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            component: () => import("@/layouts/app.vue"),
            meta: {
                requiresAuth: true,
            },
            children: [
                {
                    path: "",
                    name: "App",
                    component: () => import("@/views/overview/index.vue"),
                },
            ],
        },
    ],
});

export default router;
