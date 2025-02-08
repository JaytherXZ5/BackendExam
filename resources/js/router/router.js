import { createRouter, createWebHistory } from "vue-router";
import Products from '../components/products/Products.vue';

const routes = [
    {
        path:'/',
        name:'products',
        component:Products
    }
]

const router = createRouter({
    history:createWebHistory(),
    routes
})

export default router