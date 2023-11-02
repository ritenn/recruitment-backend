import { createRouter, createWebHistory } from 'vue-router'
import BooksIndex from "../views/Books/Index.vue";
import BooksEdit from "../views/Books/Edit.vue";

const routes = [
    {
        path: '/',
        name: 'BooksList',
        component: BooksIndex
    },
    {
        path: '/add',
        name: 'BookCreate',
        component: BooksEdit
    },
    {
        path: '/update/:id',
        name: 'BookUpdate',
        component: BooksEdit
    }
];

const router = createRouter({
    history: createWebHistory(),
    base: '/',
    routes
});

export default router
