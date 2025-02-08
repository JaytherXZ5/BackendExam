<template>
<div class=" flex flex-wrap border m-5 w-full ">
    <div class="overflow-x-auto border shadow-md w-full">
      <div class="flex justify-between p-2 gap-3">
          <div class=" px-2 flex items-center font-bold ">
            <h1>PRODUCTS</h1>
          </div>
          <div class="w-[50%] flex flex-row">
            <button class="border px-2 rounded-l-md bg-gray-500 text-white flex items-center">
              <box-icon color="white" name='search-alt'></box-icon>
            </button>
            <input class="w-full h-full px-2 rounded-r-md border" placeholder="Search" type="text">
          </div>

          <button @click="createProduct" class=" border py-1 px-2 rounded-md bg-gray-500 text-white">
                  Create
          </button>

      </div>
      <div>
        <table class="table">
          <thead>
          <tr>
              <th>
                #
              </th>
              <th>Item</th>
              <th>Category</th>
              <th>Desc</th>
              <th>Date & Time</th>
              <th>Actions</th>
          </tr>
          </thead>
          <tbody>

          <tr>
              <th>1</th>
              <td class="">
              <div class="flex items-center gap-3">
                  <div class="avatar">
                  <div class="mask mask-squircle h-12 w-12">
                      <img
                      src="https://img.daisyui.com/images/profile/demo/2@94.webp"
                      alt="Avatar Tailwind CSS Component" />
                  </div>
                  </div>
                  <div>
                  <div class="font-bold">Hart Hagerty</div>
                  <div class="text-sm opacity-50">United States</div>
                  </div>
              </div>
              </td>

              <td>Category</td>
              <th>
              <button class="btn btn-ghost btn-xs">details</button>
              </th>
              <td>
                10/10/25
              </td>
              <td>
                <button class="btn btn-ghost btn-xs">edit</button>
                <button class="btn btn-ghost btn-xs">del</button>
              </td>
          </tr>

          <tr>
              <th>2</th>
              <td>
              <div class="flex items-center gap-3">
                  <div class="avatar">
                  <div class="mask mask-squircle h-12 w-12">
                      <img
                      src="https://img.daisyui.com/images/profile/demo/3@94.webp"
                      alt="Avatar Tailwind CSS Component" />
                  </div>
                  </div>
                  <div>
                  <div class="font-bold">Brice Swyre</div>
                  <div class="text-sm opacity-50">China</div>
                  </div>
              </div>
              </td>
              <td>Category</td>
              <th>
              <button class="btn btn-ghost btn-xs">details</button>
              </th>
              <td>
                10/10/25
              </td>
          </tr>

          <tr>
              <th>3</th>
              <td>
              <div class="flex items-center gap-3">
                  <div class="avatar">
                  <div class="mask mask-squircle h-12 w-12">
                      <img
                      src="https://img.daisyui.com/images/profile/demo/4@94.webp"
                      alt="Avatar Tailwind CSS Component" />
                  </div>
                  </div>
                  <div>
                  <div class="font-bold">Marjy Ferencz</div>
                  <div class="text-sm opacity-50">Russia</div>
                  </div>
              </div>
              </td>
              
              <td>Category</td>
              <th>
              <button class="btn btn-ghost btn-xs">details</button>
              </th>
              <td>
                10/10/25
              </td>
          </tr>

          <tr>
              <th>4</th>
              <td>
              <div class="flex items-center gap-3">
                  <div class="avatar">
                  <div class="mask mask-squircle h-12 w-12">
                      <img
                      src="https://img.daisyui.com/images/profile/demo/5@94.webp"
                      alt="Avatar Tailwind CSS Component" />
                  </div>
                  </div>
                  <div>
                  <div class="font-bold">Yancy Tear</div>
                  <div class="text-sm opacity-50">Brazil</div>
                  </div>
              </div>
              </td>
              <td>Category</td>
              <th>
                <button class="btn btn-ghost btn-xs">details</button>
              </th>
              <td>
                10/10/25
              </td>
          </tr>
          </tbody>
      </table>
      </div>
      <div class="py-2 flex justify-center border">
        Pagination
      </div>

    </div>
</div>
</template>
  
<script setup>

import { useRouter } from 'vue-router'
const router = useRouter();

const createProduct = () =>{
  router.push('/products/create');
}

</script>
  