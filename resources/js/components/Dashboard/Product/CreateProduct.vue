<template>
    <div class="flex flex-col m-5 w-full rounded-md ">
        <div class=" flex justify-between px-2 py-4 gap-3">
            <h1 class="text-xl font-bold">CREATE PRODUCT</h1>
        </div>
        <div class="mx-2 border shadow-sm"></div>
        <div class="flex-1 h-full w-full my-4">
            <div class="w-full flex ">
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
                        <select v-model="form.category"
                            class="shadow-inner select select-bordered w-full max-w-xs">
                            <option disabled selected>Choose Category?</option>
                            <option>Food</option>
                            <option>Shirt</option>
                        </select>
                    </div>

                </div>
                
                <div class="w-full">
                    <!--UPLOAD IMAGES-->
                    <div>
                        <h1 class="font-bold">UPLOAD IMAGE</h1>
                    <div v-if="form.previewImages.length">
                        <h3>Preview:</h3>
                        <div class="preview-container w-[250px] h-[250px] overflow-auto flex-wrap">
                            <div v-for="(image, index) in form.previewImages" :key="index">
                                <img :src="getImage(image)" alt="image preview" class="border rounded-md shadow-inner w-[200px] h-[200px]" />
                            </div>
                        </div>
                    </div>

                    <input type="file" multiple @change="handleFileChange">
                    <button @click="clear">Clear</button>
                </div>

                    <!-- eND OF UPLOAD IMAGES-->
                    <div>
                        <div class="">
                            <h1>Description</h1>
                            <textarea v-model="form.description" class="shadow-inner focus:outline-gray-500 w-[70%] border p-2 h-[150px] rounded-md" placeholder="Item Description"></textarea>
                        </div>
                    </div>
                    
                    <div>
                        <Datepicker v-model="form.date" />
                    </div>
                    <div class="flex justify-start">
                        <button  class="border-2 border-black bg-gray-700 text-white my-2 py-2 px-6 rounded-md
                                 hover:bg-white hover:text-black hover:transform duration-300"
                                  @click="handleSubmit">Submit</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>
<script setup>

    import { reactive } from 'vue';
    import axios from 'axios';
    import Datepicker from 'vue3-datepicker';
    import { useRouter } from 'vue-router';
    import Swal from 'sweetalert2';

    window.Swal = Swal
    const toast = Swal.mixin({
        toast:true,
        position:'top-end',
        showConfirmButton: false,
        timer:3000,
        timerProgressBar:true,
    })
    window.toast = toast;

    const router = useRouter();

    const form = reactive({
        name: "",
        description:"",
        category:"",
        date: new Date(),

        images: [],
        selectedImages:[],
        previewImages: [],
    })


    const handleFileChange = async (e)=>{
        form.selectedImages = Array.from(e.target.files);
        const images = e.target.files;
        form.previewImages = [];


        Array.from(images).forEach((image)=>{
            let reader = new FileReader();
            reader.onloadend = ()=>{
                form.previewImages.push(reader.result)
            }
            reader.readAsDataURL(image);
        })
        console.log(form.selectedImages)
    }
    const getImage = (image) => {
        let defaultImage = "/upload/no-image.png";
        if (image) {
            if (image.indexOf("base64") !== -1) {
            return image; // Base64 preview
            } else {
            return "/upload/" + image; // Fallback for uploaded images
            }
        }
        return defaultImage;
    };

    const handleSubmit = async ()=>{
        const formData = new FormData();
        formData.append('name', form.name);
        formData.append('description', form.description);
        formData.append('category', form.category);
        formData.append('date', form.date.toISOString().split('T')[0]);
        form.selectedImages.forEach((image)=>{
            formData.append('images[]',image);  
        });

        try{
            await axios.post(`/api/create_product`, formData).then((response)=>{
                router.push('/products');
                toast.fire({icon: "success", title: "Product Added Successfully"})
            });
            
        }catch(error){
            console.log(error)
        }

    }

</script>