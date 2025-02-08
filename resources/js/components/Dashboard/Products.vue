<template>
<div class="flex-1 flex border items-center justify-center">
    <div class="overflow-x-auto border shadow-md">
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

          <!--Open Product Modal Button-->
          <button class=" border py-1 px-2 rounded-md bg-gray-500 text-white"
                  onclick="openProductModal.showModal()">
                  Add Product
          </button>
          
          <!--Add Product Modal-->
            <dialog id="openProductModal" class="modal flex items-start justify-center ">
              <div class="modal-box w-full">
                <form method="dialog">
                  <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                  <div class="mt-5 rounded-md">
                      <div class="">
                        <h1>Name</h1>
                        <input type="text" class="border focus:outline-gray-500 p-2 rounded-md w-[70%] placeholder:text-sm" placeholder="Item name">
                      </div>
                      <div>
                        <h1>Description</h1>
                        <textarea class=" focus:outline-gray-500 w-[70%] border p-2 h-[100px] rounded-md" placeholder="Item Description"></textarea>
                      </div>
                      <div class="">
                        <h1>Upload Image</h1>
                        <img src="" alt="image" class="border rounded-md shadow-inner w-24 h-24">
                        <input class="file:rounded-md file:bg-gray-700 file:text-white file:outline-none file:border-none my-2" type="file">
                      </div>
                      <div>
                        <h1>Category</h1>
                        <select class="select select-bordered w-full max-w-xs">
                          <option disabled selected>Choose Category?</option>
                          <option>Food</option>
                          <option>Shirt</option>
                        </select>
                      </div>
                      <div>
                        <div class="">
                          <h1>Price</h1>
                          <input type="number" class="border focus:outline-gray-500 p-2 rounded-md w-[70%] placeholder:text-sm" placeholder="Price">
                        </div>
                      </div>
                      <div>
                        <div class="">
                          <h1>Quantity</h1>
                          <input type="number" class="border focus:outline-gray-500 p-2 rounded-md w-[70%] placeholder:text-sm" placeholder="Quantity">
                        </div>
                      </div>

                  </div>

                  <!--Save Product------------------------>
                  <div class="flex justify-end">
                    <!--Save Button----------------------------->
                    <button class="border-2 py-2 px-2 rounded-md mt-2 shadow-md bg-gray-700 text-white hover:border-2 hover:border-black hover:bg-white hover:text-black hover:transition duration-500"
                            @click.prevent onclick="saveProduct.showModal()"
                            @click="handleSave"
                            >Save Product </button>
                      <!--Alert Dialog--------------------->
                            <dialog id="saveProduct" class="modal">
                              <div class="modal-box">
                                <h3 class="text-lg font-bold">Success!</h3>
                                <p class="py-4">Product Created</p>
                              </div>
                              <form method="dialog" class="modal-backdrop">
                                <button>close</button>
                              </form>
                            </dialog>
                  </div>

                </form>
              </div>
            </dialog>

            

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
  const form ={
    name: "",
    description: "",
    image: "",
    type: "",
    quantity:"",
    price: ""
  }

  const handleSave =()=>{
    
  }

</script>
  