
<template>
    <div class="h-screen w-screen bg-fixed ">
        <div class="flex-1 flex h-full ">
             <SideNav/>
             <Products/>
        </div>

    </div>

</template>

<script setup>
import Products from './Products.vue'
import SideNav from '../Dashboard/SideNav.vue'

</script>