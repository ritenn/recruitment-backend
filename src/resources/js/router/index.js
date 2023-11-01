import { createRouter, createWebHistory } from 'vue-router'
import BooksIndex from "../views/Books/Index.vue";

const routes = [
    {
        path: '/:catchAll(.*)',
        name: 'Books list',
        component: BooksIndex
    }
];

const router = createRouter({
    history: createWebHistory(),
    base: '/',
    routes
});

export default router
