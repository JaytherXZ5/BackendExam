<template>
    <div class="border h-full lg:w-[275px] shadow-xl">
        <div class="m-1 h-full flex-col justify-start">
            <div class="border-b shadow-md m-1 py-4 flex items-center gap-3 justify-center">
                
                <h1 class="text-xl font-bold">ADMIN</h1>
            </div>
            <div class=" border-b m-1 py-4 flex flex-row gap-2 justify-start items-center">
                <div class="w-16 h-12 ">
                    <div class="w-full h-full "><box-icon class="w-full h-full" color="#3a3c46" name='user-circle' type='solid' ></box-icon></div>
                </div>
                <h1 class="font-bold">Jayther Jann</h1>
            </div>
            <router-link to="/dashboard">
                <div class="p-1 hover:translate-x-2 hover:bg-gray-200 
                            cursor-pointer hover:rounded-l-sm duration-300 border-b flex gap-2 items-center
                            ">
                    <div class="w-10 h-10 "> <box-icon class="w-full h-full" type='solid' name='dashboard'></box-icon> </div>
                    <h1>Dashboard</h1>
                </div>
            </router-link>
            
            <router-link to="/create_product" >
                <div class="p-1 hover:translate-x-2 hover:bg-gray-200 
                            cursor-pointer hover:rounded-l-sm duration-300
                            border-b flex gap-2 items-center">
                
                    <div class="w-10 h-10">
                        <div class="w-2 h-2">+</div>
                        <box-icon class="ml-1 w-[90%] h-[90%]" name='package' type='solid' ></box-icon>
                    </div>
                    <h1>Create Product</h1>
                </div>
            </router-link>

            <router-link to="/videos">
                <div class="p-1 hover:translate-x-2 hover:bg-gray-200 
                            cursor-pointer hover:rounded-l-sm duration-300
                            border-b flex gap-2 items-center">
                    <div class="w-10 h-10"><box-icon class="w-full h-full" name='videos' type='solid' ></box-icon></div>
                    <h1>
                        Videos
                    </h1>
                </div >
            </router-link>

            <div class="p-1 hover:translate-x-2 hover:bg-gray-200 
                        cursor-pointer hover:rounded-l-sm duration-300
                        border-b flex gap-2 items-center">
                        
                <div class="w-10 h-10"><box-icon class="w-full h-full" name='exit' type='solid' ></box-icon></div>
                <button @click="logoutUser">
                    Logout
                </button>
            </div>
        </div>

    </div>
</template>

<script setup>
    import { useRouter } from 'vue-router';
    import axios from 'axios';

    const router = useRouter();

    const logoutUser = async () => {
    try {
        await axios.post('/api/logout', {}, {
        headers: { Authorization: `Bearer ${localStorage.getItem('authToken')}` }
        });
        localStorage.removeItem('authToken');
        router.push('/');
    } catch (error) {
        console.error('Logout failed', error);
    }
    };
</script>