import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../components/home/Home.vue'),
    },
    {
        path: '/product/list',
        name: 'product.index',
        component: () => import('../components/product/index.vue'),
    },
    {
        path: '/product/create',
        name: 'product.create',
        component: () => import('../components/product/create.vue'),
    },
    {
        path: '/product/edit/:id',
        name: 'product.edit',
        component: () => import('../components/product/create.vue'),
    },
    {
        path: '/user/list',
        name: 'user.index',
        component: () => import('../components/user/index.vue'),
    },
    {
        path: '/user/create',
        name: 'user.create',
        component: () => import('../components/user/create.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
