<template>
    <div class="flex flex-col m-5 w-full rounded-md ">
        <div class=" flex justify-between px-2 py-4 gap-3">
            <h1 class="text-xl font-bold">CREATE PRODUCT</h1>
        </div>
        <div class="mx-2 border shadow-sm"></div>
        <div class="flex-1 h-full w-full my-4">
            <form action="" class="w-full flex ">
                <div class="w-[50%]">
                    <div class="p-3 ">
                        <h1>PRODUCT NAME</h1>
                        <input  v-model="form.name"
                                type="text" 
                                placeholder="Product" 
                                class="shadow-inner input input-bordered w-full max-w-xs" />
                    </div>


                    <div class="p-3">
                        <h1>Category</h1>
                        <select v-model="form.type"
                            class="shadow-inner select select-bordered w-full max-w-xs">
                            <option disabled selected>Choose Category?</option>
                            <option>Food</option>
                            <option>Shirt</option>
                        </select>
                    </div>
                    <div class=" p-3">
                        <h1>Price</h1>
                        <input v-model="form.price"
                            type="number" 
                            class="shadow-inner border py-3 focus:outline-gray-500 p-2 rounded-md w-full max-w-xs placeholder:text-sm" placeholder="Price">
                    </div>
                    <div class=" p-3">
                        <h1>Quantity</h1>
                        <input v-model="form.quantity"
                            type="number" 
                            class="shadow-inner border py-3 focus:outline-gray-500 p-2 rounded-md w-full max-w-xs placeholder:text-sm" placeholder="Quantity">
                    </div>
                </div>

                <div class="w-full">
                    <h1 class="font-bold">UPLOAD IMAGE</h1>
                    <img :src="getImage()" alt="image" class="border rounded-md shadow-inner w-[200px] h-[200px]">
                    <input @change="handleFileChange"  
                        class="file:rounded-md file:hover:cursor-pointer file:bg-gray-700 file:text-white file:py-2 file:outline-none file:border-none my-2" type="file">
                    <div>
                        <div class="">
                            <h1>Description</h1>
                            <textarea class="shadow-inner focus:outline-gray-500 w-[70%] border p-2 h-[150px] rounded-md" placeholder="Item Description"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-start">
                        <button  class="border-2 border-black bg-gray-700 text-white my-2 py-2 px-6 rounded-md
                                 hover:bg-white hover:text-black hover:transform duration-300"
                                 @click="handleSave">Create</button>
                    </div>
                </div>

                
            </form>
        </div>


    </div>
</template>
<script setup>

    import { reactive } from 'vue';

    const form = reactive({
        name: "",
        description:"",
        image: "",
        type:"",
        quantity:"",
        price:""
    })

    const handleSave = ()=>{
        axios.post('/products',form)
    }

    const handleFileChange=(e)=>{
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onloadend = (file) =>{
            form.image = reader.result
        }
        reader.readAsDataURL(file)
    }

    const getImage = ()=>{
        let image = '/upload/no-image.png';
        if (form.image){
            if(form.image.indexOf("base64") != -1){
                image = form.image;
            }else{
                image = "/upload/"+ form.image;
            }
        }
        return image;
    }

</script>