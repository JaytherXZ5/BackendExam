<template>
<div class="flex-1 flex border items-center justify-center">
    <div class="overflow-x-auto border shadow-md">
      <div class="flex justify-between p-2 gap-3">
          <div class=" px-2 flex items-center font-bold ">
            <h1>PRODUCTS</h1>
          </div>
          <div class="w-[50%] flex flex-row">
            <button class="border px-2 rounded-l-md bg-gray-500 text-white"></button>
            <input class="w-full h-full px-2 rounded-r-md border" placeholder="Search" type="text">
          </div>

          <!--Add Product Modal Button-->
          <button class=" border py-1 px-2 rounded-md bg-gray-500 text-white"
                  onclick="addProductModal.showModal()">
                  Add Product
          </button>
          
          <!--Add Product Modal-->
            <dialog id="addProductModal" class="modal flex items-start justify-center mt-10">
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
                      <div class="border">
                        <h1>Upload Image</h1>
                        <input type="file">
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
                        <input type="number" class="border focus:outline-gray-500 p-2 rounded-md w-[70%] placeholder:text-sm" placeholder="Item name">
                      </div>
                      </div>

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
  
  <script>
  export default {
    data() {
      return {
        users: [
          { id: 1, name: "Alice", email: "alice@example.com" },
          { id: 2, name: "Bob", email: "bob@example.com" },
          { id: 3, name: "Charlie", email: "charlie@example.com" },
          { id: 4, name: "David", email: "david@example.com" },
          { id: 5, name: "Emma", email: "emma@example.com" },
          { id: 6, name: "Frank", email: "frank@example.com" },
        ],
        currentPage: 1,
        perPage: 2,
      };
    },
    computed: {
      totalPages() {
        return Math.ceil(this.users.length / this.perPage);
      },
      paginatedUsers() {
        let start = (this.currentPage - 1) * this.perPage;
        return this.users.slice(start, start + this.perPage);
      },
    },
    methods: {
      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.currentPage++;
        }
      },
      prevPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
        }
      },
    },
  };
  </script>
  