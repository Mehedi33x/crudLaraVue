import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '../components/home/Home.vue'
import productIndex from '../components/product/index.vue'
import productCreate from '../components/product/create.vue'
import userCreate from '../components/user/create.vue'

const routes =[
    {
        path: '/',
        name: 'home',
        component: HomePage,
    },
    {
        path: '/product/list',
        name: 'product.index',
        component: productIndex
    },
    {
        path: '/product/create',
        name: 'product.create',
        component: productCreate
    },
    {
        path: '/product/edit/:id',
        name: 'product.edit',
        component: productCreate
    },
    {
        path: '/user/create',
        name: 'user.create',
        component: userCreate
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;