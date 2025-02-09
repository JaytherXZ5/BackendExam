
<template>
    <div class="h-screen w-screen ">
        <div class="flex-1 flex h-full w-full p-2 ">
             <SideNav/>
             <Products v-if="isProducts"/>
             <CreateProduct v-if="isCreateProduct"/>
        </div>

    </div>

</template>

<script setup>
import Products from './Product/Products.vue'
import SideNav from '../Dashboard/SideNav.vue'
import CreateProduct from './Product/CreateProduct.vue';

import { computed } from "vue";
import { useRoute } from "vue-router";
const route = useRoute();

const isCreateProduct = computed(() => route.path === "/create_product");
const isProducts = computed(() => route.path === "/products");
</script>