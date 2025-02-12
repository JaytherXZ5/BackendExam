<template>
<div class=" flex flex-col border rounded-md shadow-md m-5 w-full ">
    <div class="overflow-x-auto w-full">
      <div class="flex justify-between p-2 gap-3">
          <div class=" px-2 flex items-center font-bold ">
            <h1>PRODUCTS</h1>
          </div>

          <!--SEARCH -->
          <div class="w-[50%] flex flex-row">
            <div class="border px-2 rounded-l-md bg-gray-700 text-white flex items-center">
              <box-icon color="white" name='search-alt'></box-icon>
            </div>
            <!--SEARCH INPUT-->
            <input class="shadow-inner w-full h-full px-2 rounded-r-md border" 
              placeholder="Search Product" 
              v-model="searchQuery" 
              type="text">
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
              <th class="text-gray-600 text-[16px] font-mono">Product</th>
              <th class="text-gray-600">
                <select v-model="selectedCategory" @change="getProducts" class="btn">
                  <option value="" >All Categories</option>
                  <option class="" v-for="category in categories" :key="category" :value="category">
                      {{ category}}
                  </option>
                </select>
              </th>
              <th class="text-gray-600 text-[16px] font-mono">Description</th>
              <th class="text-gray-600 text-[16px] font-mono">Date & Time</th>
              <th class="text-gray-600 text-[16px] font-mono">Actions</th>
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
                <div ><p class="text-xs text-gray-600">{{ product.description.length > 30 ? product.description.substring(0, 30) + "..." : product.description }}</p></div>
                <div>
                    <button @click="showDescription(product.description)" class="btn btn-ghost btn-xs border text-gray-400">see more</button>
                    
                </div>
              </th>
              <td>
                {{product.date}}
              </td>
              <td class="">
                <div class="flex gap-2">
                  <div class="w-10 h-10 border rounded-lg">
                    <!--EDIT-->
                    <button @click="onEdit(product.id)" class="w-full h-full btn btn-ghost btn-xs"> <box-icon color="#0a1185" class="w-full h-full"  name='edit' type='solid' ></box-icon></button>
                  </div>
                  <div class="w-10 h-10 border rounded-lg">
                    <!--DELETE-->
                    <button @click="deleteProduct(product.id)" class="w-full h-full btn btn-ghost btn-xs"><box-icon color="red" class="w-full h-full" type='solid' name='trash'></box-icon></button>
                  </div>

                </div>

              </td>
          </tr>


          </tbody>
      </table>
      </div>



    </div>

    <!--Pagination-->
    <div class="py-2 flex justify-center">
        <a href="#"
            class="btn"
            v-for="(link,index) in links"
            :key="index"
            v-html="link.label"
            :class="{ 
                'bg-gray-700 text-white': link.active, 
                'opacity-50 cursor-not-allowed hidden': !link.url 
            }"
            @click="changePage(link)"></a>
      </div>

          <!-- LOADING MODAL -->
      <div v-if="loading" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg flex justify-center items-center">
          <h2 class="text-lg font-bold"><span class="loading loading-ring loading-lg"></span></h2>
          <p>Please wait while we fetch data.</p>
        </div>
      </div>
      <!--MODAL DESC-->
      <div v-if="close_desc" class="absolute border w-[400px] h-[300px] overflow-y-auto rounded-md shadow-2xl flex flex-col justify-evenly bg-white top-[30%] left-[40%]
            p-5">
          <textarea disabled class="h-[400px]">{{ description }}</textarea>
          <button @click="closeDesc" class="btn mt-2 mx-[30%]">Close</button>
      </div>
      
</div>
</template>
  
<script setup>

import { useRouter } from 'vue-router'
import { ref,onMounted,watch } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
const router = useRouter();

let products = ref([]);
let links = ref([]);
let loading = ref(false);
let close_desc = ref(false);
let searchQuery = ref('');
const categories = ref(['Appliances', 'Books', 'Clothing','Gadgets']);
const selectedCategory = ref('');
const description = ref('');
onMounted(async ()=>{
  getProducts();
})



watch(searchQuery, ()=>{
  getProducts()
})

const showDescription = (desc) =>{
  close_desc.value = true;
  description.value = desc;
}

const closeDesc = ()=>{
  close_desc.value = false;
  description.value = '';

}

const createProduct = () =>{
  router.push('/create_product');
}

const onEdit = (id) =>{
  router.push(`/products/${id}/edit`)
}

const deleteProduct=(id)=>{
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
}).then((result) => {
    loading.value = true
    if (result.isConfirmed) {

      axios.delete(`/api/products/${id}`).then(()=>{
        Swal.fire({
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success"
        });
      })
      loading.value=false;
      getProducts();
    }
  });
}

const getProducts = async ()=>{
    let response = await axios.get('/api/products',{
      params: {
        searchQuery: searchQuery.value,
        category: selectedCategory.value
      }
    }).then((response)=>{
      products.value = response.data.products.data;
      links.value = response.data.products.links;
    })

  
}

const changePage = (link)=>{
  loading.value = true;
  if(!link.url || link.active){
    loading.value = false;
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
  