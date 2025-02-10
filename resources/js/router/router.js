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
        component:Login,
        redirect: () => {
            return localStorage.getItem('authToken') ? '/dashboard' : '/';
        }
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
        meta: { requiresAuth: true },
        children:[
            {
                path:'/products',
                name:'products',
                component:Products,
                meta: { requiresAuth: true },
            },
            {
                path:'/create_product',
                name:'createProduct',
                component:CreateProduct,
                meta: { requiresAuth: true },
            }
        ]
    }
]

const router = createRouter({
    history:createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('authToken'); // Check if token exists
  
    if (to.meta.requiresAuth && !isAuthenticated) {
      next('/'); // Redirect to login if not authenticated
    } else {
      next(); // Allow navigation
    }
});

export default router