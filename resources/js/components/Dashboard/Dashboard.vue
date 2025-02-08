
<template>
    <div class="h-screen w-screen bg-fixed ">
        <div class="flex-1 flex h-full ">
             <SideNav/>
             <Products/>
        </div>

    </div>

</template>

<script>
import Products from './Products.vue'
import SideNav from '../Dashboard/SideNav.vue'
export default{
    components:{
        Products, SideNav
    }
}
</script>