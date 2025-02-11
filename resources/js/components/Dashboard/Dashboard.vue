
<template>
    <div class="h-screen w-screen ">
        <div class="flex-1 flex h-full w-full p-2 ">
             <SideNav/>
             <Products v-if="isProducts || isDashboard "/>
             <CreateProduct v-if="isCreateProduct || isEditProduct"/>
             <Videos v-if="isVideos"/>
        </div>

    </div>

</template>

<script setup>
import Products from './Product/Products.vue'
import SideNav from '../Dashboard/SideNav.vue'
import CreateProduct from './Product/CreateProduct.vue';
import Videos from './Video/Videos.vue';

import { computed } from "vue";
import { useRoute } from "vue-router";
const route = useRoute();

const isCreateProduct = computed(() => route.path === "/create_product");
const isEditProduct = computed(() => route.name === "editProduct");
const isProducts = computed(() => route.path === "/products");
const isDashboard = computed(() => route.path === "/dashboard");
const isVideos = computed(()=>route.path=== "/videos")
</script>