import { createRouter, createWebHistory } from "vue-router";
import NotFound from '../NotFound.vue';
import Dashboard from '../components/Dashboard/Dashboard.vue';
import Login from '../components/Auth/Login.vue';
import Products from '../components/Dashboard/Product/Products.vue';
import CreateProduct from '../components/Dashboard/Product/CreateProduct.vue';
const routes = [

    {
        path:'/',
        name:'login',
        component:Login
    },

    {
        path:'/:notFound(.*)*',
        name:'notFound',
        component: NotFound
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        children:[
            {
                path:'/products',
                name:'products',
                component:Products
            },
            {
                path:'/create_product',
                name:'createProduct',
                component:CreateProduct,
            }
        ]
    }
]

const router = createRouter({
    history:createWebHistory(),
    routes
})

export default router