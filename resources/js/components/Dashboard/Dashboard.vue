
<template>
    <div class="h-screen w-screen ">
        <div class="flex-1 flex h-full w-full p-2 ">
             <SideNav/>
             <Products/>
        </div>

    </div>

</template>

<script setup>
import Products from './Product/Products.vue'
import SideNav from '../Dashboard/SideNav.vue'

</script>