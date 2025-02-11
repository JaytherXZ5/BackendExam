import { createRouter, createWebHistory } from "vue-router";
import NotFound from '../NotFound.vue';
import Dashboard from '../components/Dashboard/Dashboard.vue';
import Login from '../components/Auth/Login.vue';
import Products from '../components/Dashboard/Product/Products.vue';
import ProductForm from '../components/Dashboard/Product/CreateProduct.vue';
import Videos from '../components/Dashboard/Video/Videos.vue';

const routes = [

    {
        path:'/',
        name:'login',
        component:Login,

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
                component:ProductForm,
                meta: { requiresAuth: true },
            },
            {
                path:'/products/:id/edit',
                name:'editProduct',
                component:ProductForm,
                meta: { requiresAuth: true },
            },
            {
                path:'/videos',
                name:'videos',
                component:Videos,
                meta: { requiresAuth: true },
            },

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