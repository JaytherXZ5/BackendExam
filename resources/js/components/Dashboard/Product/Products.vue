<template>
<div class=" flex flex-col border m-5 w-full ">
    <div class="overflow-x-auto w-full">
      <div class="flex justify-between p-2 gap-3">
          <div class=" px-2 flex items-center font-bold ">
            <h1>PRODUCTS</h1>
          </div>
          <div class="w-[50%] flex flex-row">
            <button class="border px-2 rounded-l-md bg-gray-700 text-white flex items-center">
              <box-icon color="white" name='search-alt'></box-icon>
            </button>
            <input class="w-full h-full px-2 rounded-r-md border" placeholder="Search" type="text">
          </div>

          <button @click="createProduct" class="mr-28 shadow-md border-2 py-1 px-2 rounded-md bg-gray-800 text-white
                  hover:bg-white hover:text-black hover:border-black duration-300 ">
                  CREATE
          </button>

      </div>
      <div>
        <table class="table">
          <thead>
          <tr class="shadow-md border-t">
              <th class="text-black font-bold">Product</th>
              <th class="text-black font-bold">Category</th>
              <th class="text-black font-bold">Desc</th>
              <th class="text-black font-bold">Date & Time</th>
              <th class="text-black font-bold">Actions</th>
          </tr>
          </thead>
          <tbody>

          <tr v-for="product in products" :key="product.id">
              
              <td class="">
              <div class="flex items-center gap-3">
                  <div class="avatar">
                  <div class="mask mask-squircle h-12 w-12">
                    <img :src="product.images?.[0]?.image_path ? '/storage/' + product.images[0]?.image_path : '/upload/no-image.png'" alt="image" />
                  </div>
                  </div>
                  <div>
                  <div class="font-bold">{{ product.name}}</div>
                  <div class="text-sm opacity-50"></div>
                  </div>
              </div>
              </td>

              <td>{{ product.category }}</td>
              <th>
                <div ><p class="text-xs text-gray-600">{{ product.description.length > 20 ? product.description.substring(0, 20) + "..." : product.description }}</p></div>
                <div>
                    <button class="btn btn-ghost btn-xs border text-gray-400">see more</button>
                </div>

              </th>
              <td>
                {{product.date}}
              </td>
              <td class="">
                <div class="flex gap-2">
                  <div class="w-10 h-10 border rounded-lg">
                    <button class="w-full h-full btn btn-ghost btn-xs"> <box-icon color="#0a1185" class="w-full h-full"  name='edit' type='solid' ></box-icon></button>
                  </div>
                  <div class="w-10 h-10 border rounded-lg">
                    <button class="w-full h-full btn btn-ghost btn-xs"><box-icon color="red" class="w-full h-full" type='solid' name='trash'></box-icon></button>
                  </div>

                </div>

              </td>
          </tr>


          </tbody>
      </table>
      </div>


    </div>

    <!--Pagination-->
    <div class="py-2 flex justify-center border">
        <a href="#"
            class="btn"
            v-for="(link,index) in links"
            :key="index"
            v-html="link.label"
            :class="{ active : link.active,disabled: !link.url}"
            @click="changePage(link)"></a>
      </div>

          <!-- LOADING MODAL -->
      <div v-if="loading" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg flex justify-center items-center">
          <h2 class="text-lg font-bold"><span class="loading loading-ring loading-lg"></span></h2>
          <p>Please wait while we fetch data.</p>
        </div>
      </div>
</div>
</template>
  
<script setup>

import { useRouter } from 'vue-router'
import { ref,onMounted } from 'vue';
import axios from 'axios';
const router = useRouter();

let products = ref([]);
let links = ref([]);
let loading = ref(false);

onMounted(async ()=>{
  getProducts()
})

const createProduct = () =>{
  router.push('/create_product');
}

const getProducts = async ()=>{
  loading.value = true;
  try {
    let response = await axios.get('/api/products');
    products.value = response.data.products.data;
    links.value = response.data.products.links;
  } catch (error) {
    console.error("Error fetching products:", error);
  } finally {
    loading.value = false;
  }
}

const changePage = (link)=>{
  loading.value = true;
  if(!link.url || link.active){
    return;
  }

  axios.get(link.url).then((response)=>{
    products.value = response.data.products.data;
    links.value = response.data.products.links
  }).catch(error => {
      console.error("Pagination error:", error);
  }).finally(() => {
      loading.value = false;
  });
}

</script>
  