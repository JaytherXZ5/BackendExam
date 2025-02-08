import { createRouter, createWebHistory } from "vue-router";
import NotFound from '../NotFound.vue';
import Dashboard from '../components/Dashboard/Dashboard.vue';
import Login from '../components/Auth/Login.vue';

const routes = [

    {
        path:'/',
        name:'login',
        component:Login
    },
    {
        path:'/products',
        name:'products',
        component:Products
    },
    {
        path:'/:notFound(.*)*',
        name:'notFound',
        component: NotFound
    },
    {
        path: '/admin',
        name: 'dashboard',
        component: Dashboard,

    }
]

const router = createRouter({
    history:createWebHistory(),
    routes
})

export default router