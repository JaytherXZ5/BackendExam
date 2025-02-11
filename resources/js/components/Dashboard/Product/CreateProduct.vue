<template>
    <div class="flex flex-col m-5 w-full rounded-md ">
        <div class=" flex justify-between px-2 py-4 gap-3">
            <h1 class="text-xl font-bold">
                <span v-if="route.name=='createProduct'">CREATE PRODUCT</span>
                <span v-if="route.name=='editProduct'">EDIT PRODUCT</span>
            </h1>
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
                                class="shadow-inner input input-bordered w-full max-w-xs"
                                />
                    </div>

                    <div class="p-3">
                        <h1>Category</h1>
                        <select v-model="form.category"
                            class="shadow-inner select select-bordered w-full max-w-xs">
                            <option disabled selected>Choose Category?</option>
                            <option value="Appliances">Appliances</option>
                            <option value="Clothing">Clothing</option>
                            <option value="Books">Books</option>
                            <option value="GadgetsAppliances">Gadgets</option>
                        </select>
                    </div>
                    <div>
                        <div class="p-3">
                            <h1>Description</h1>
                            <textarea v-model="form.description" class="shadow-inner focus:outline-gray-500 w-[100%] border p-2 h-[150px] rounded-md" placeholder="Item Description"></textarea>
                        </div>
                    </div>
                    <div  class="p-3 flex justify-start">
                        <button  class="border-2 border-black bg-gray-700 text-white my-2 py-2 px-6 rounded-md
                                 hover:bg-white hover:text-black hover:transform duration-300"
                                  @click="handleSubmit">Submit</button>
                    </div>
                </div>
                <div  class="ml-24 w-full p-3">
  
                    <!--UPLOAD IMAGES-->
                    <div class="mt-5">
                        <h1 class="font-bold">UPLOAD <span v-if="editMode">NEW</span> IMAGES</h1>
                        <div>
                            <button class="border-2 border-black bg-gray-700 text-white my-2 py-1 px-6 rounded-md
                                        hover:bg-white hover:text-black hover:transform duration-300" @click="clear">
                                Clear
                            </button>
                            <input class="file:border-2 file:border-black file:bg-gray-700 file:text-white file:my-2 file:py-1 file:px-6 file:rounded-md
                            file:hover:bg-white file:hover:text-black file:hover:transform file:duration-300 file:mx-2" type="file" multiple @change="handleFileChange">
                            
                            <!--(Edit mode)show current product of image-->
                            <div v-if="editMode" class="  mt-5 preview-container w-[350px] overflow-auto flex-row">
                                <h1 >CURRENT IMAGES:</h1>
                                <div class="border p-2 rounded-md shadow-md grid grid-cols-3 gap-4">
                                    <div v-for="(image, index) in form.currentImagePreview.slice(0, 5)" 
                                        :key="index" 
                                        class="flex justify-center">
                                        <img :src="image" 
                                            alt="image preview" 
                                            class="border rounded-md shadow-inner w-[100px] h-[100px]" />
                                    </div>
                                </div>
                            </div>

                            <!--(Edit mode)show selected new product of image-->
                            <div v-if="editMode" class="  mt-5 preview-container w-[350px] overflow-auto flex-row">
                                <h1 >SELECTED NEW IMAGES:</h1>
                                <div class="border p-1 rounded-md h-28 grid grid-cols-3 gap-4">
                                    <div v-for="(image, index) in form.previewImages.slice(0, 5)" 
                                        :key="index" 
                                        class="flex justify-center">
                                        <img :src="getImage(image)" 
                                            alt="image preview" 
                                            class="border rounded-md shadow-inner w-[100px] h-[100px]" />
                                 </div>
                                </div>
                            </div>
                            
 
                            <!-- (CREATE PRODUCT MODE) Show selected images-->
                            <div v-if="!editMode" class="  mt-5 preview-container w-[350px] overflow-auto flex-row">
                                <h1 >SELECTED IMAGES:</h1>
                                <div class="grid grid-cols-3 gap-4">
                                    <div v-if="!editMode" v-for="(image, index) in form.previewImages.slice(0, 5)" 
                                        :key="index" 
                                        class="flex justify-center">
                                        <img :src="getImage(image)" 
                                            alt="image preview" 
                                            class="border rounded-md shadow-inner w-[100px] h-[100px]" />
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- eND OF UPLOAD IMAGES-->
                    <div class="mt-5 flex flex-row items-center gap-2">
                        <h1>PICK DATE:</h1>
                        <div class="w-8 h-8">
                            <box-icon class="w-full h-full" name='calendar' type='solid' color='#3a3c46' ></box-icon>
                        </div>
                        <Datepicker class="border p-2 shadow-inner rounded-md" v-model="form.date" />
                    </div>
                </div>
            </div>
        </div>
        

    </div>
</template>
<script setup>

    import { ref,reactive,onMounted } from 'vue';
    import axios from 'axios';
    import Datepicker from 'vue3-datepicker';
    import { useRouter, useRoute } from 'vue-router';
    import Swal from 'sweetalert2';
import { ErrorCodes } from 'vue';

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
    const route = useRoute();

    const form = reactive({
        name: "",
        description:"",
        category:"",
        date: new Date(),

        images: [],
        selectedImages:[],
        previewImages: [],
        currentImagePreview: [],
    })

    const editMode = ref(false);

    onMounted(()=>{
        if(route.name === 'editProduct'){
            editMode.value = true;
            getProduct()
        }
        
    })

    const getProduct = ()=>{
        axios.get(`/api/products/${route.params.id}/edit`).then((response)=>{
            form.name = response.data.product.name
            form.description = response.data.product.description
            form.category = response.data.product.category
            form.currentImagePreview = response.data.product.images.map(image => `/storage/${image.image_path}`);
        })
    }



    const clear =()=>{
        form.previewImages = [];
        form.selectedImages =[];

    }

    const handleFileChange = (e)=>{
        form.selectedImages = Array.from(e.target.files);
        form.previewImages=[]
        const images = e.target.files;
      

        Array.from(images).forEach((image)=>{
            let reader = new FileReader();
            reader.onloadend = ()=>{
                form.previewImages.push(reader.result)
                form.selectedImages.push(reader.result)
            }
            reader.readAsDataURL(image);
        })

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

    const handleSubmit = (values, actions)=>{
        if(editMode.value){
            updateProduct(values, actions)
            editMode.value = false;
        }else{
            createProduct(values, actions)
        }
    }

    const updateProduct = async (values, actions)=>{
        const formData = new FormData();
        formData.append('name', form.name);
        formData.append('description', form.description);
        formData.append('category', form.category);
        formData.append('date', form.date.toISOString().replace('T', ' ').split('.')[0]);
        form.selectedImages.forEach((image)=>{
            formData.append('images[]',image);
        });
        try{
            await axios.post(`/api/products/${route.params.id}`, formData).then((response)=>{
                router.push('/products');
                toast.fire({icon: "success", title: "Product Updated Successfully"})
            });
        }catch(error){
            if(error.response.status === 422){
                ErrorCodes.value = error.response.data.errors
            }
        }
    }

    const createProduct = async (values, actions)=>{
        const formData = new FormData();
        formData.append('name', form.name);
        formData.append('description', form.description);
        formData.append('category', form.category);
        formData.append('date', form.date.toISOString().replace('T', ' ').split('.')[0]);
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