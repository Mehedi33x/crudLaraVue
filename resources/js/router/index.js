import { createRouter, createWebHistory } from 'vue-router';
import productIndex from '../components/product/index.vue'
import productCreate from '../components/product/create.vue'
const routes =[
    {
        path: '/',
        name: 'product.index',
        component: productIndex
    },
    {
        path: '/product/create',
        name: 'product.create',
        component: productCreate
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;