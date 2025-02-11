<template>

    <div class="border flex justify-center items-center h-screen w-screen flex-col">
        <div class=" xs:w-[70%] sm:w-[70%] lg:w-[600px] h-[350px] flex flex-row">
            <div class="flex-1 rounded-l-xl shadow-xl  bg-geo bg-cover flex-col bg-no-repeat bg-center flex ">
                <h1 class="p-5 flex justify-center text-white text-2xl font-bold">LOGIN</h1>
                <div class="border mx-2"></div>
                <h1 class=" pt-5 text-white text-2xl font-bold flex justify-center font-serif">WELCOME</h1>
                <h1 class="  text-white text-2xl font-bold flex justify-center font-serif">ADMIN</h1>
            </div>
            
            <div class="flex items flex-col p-5 border-2 border-black shadow-xl w-[60%] rounded-r-xl">

                <div class="my-3">
                    <h1 class="font-bold">EMAIL OR USERNAME</h1>
                    <label class="shadow-md input input-bordered flex items-center border-black border-2  gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 16 16"
                            fill="currentColor"
                            class="h-4 w-4 opacity-70">
                            <path
                            d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                            <path
                            d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                        </svg> | <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 16 16"
                            fill="currentColor"
                            class="h-4 w-4 opacity-70">
                            <path
                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                        </svg>
                        <input v-model="form.login" type="text" class="grow" placeholder="Email or Username" />
                </label>
                </div>
                
                <div class="my-1">
                    <h1 class="font-bold">PASSWORD</h1>
                    <label class="shadow-md input input-bordered border-black border-2 flex items-center gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 16 16"
                            fill="currentColor"
                            class="h-4 w-4 opacity-70">
                            <path
                            fill-rule="evenodd"
                            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                            clip-rule="evenodd" />
                        </svg>
                        <input v-model="form.password" type="password" class=" grow" value="password" />
                    </label>
                </div>


                <div class="flex gap-2 flex-row border-b p-1 justify-center items-center ">
                        <p class="text-sm">Remember me</p>
                        <input v-model="form.remember" type="checkbox" class="border-black w-5 h-5  border-2 shadow-inner checkbox p-1" />
                </div>
                
                <div class="flex justify-center mt-2">
                    <button @click="loginUser" class="btn btn-outline border-2 bg-gray-700 text-white">LOGIN</button>
                </div>


            </div>
        </div>
    </div>



</template>

<script setup>
    import { reactive, ref,onMounted} from 'vue';
    import axios from 'axios';
    import { useRouter } from 'vue-router';


    const router = useRouter();

    onMounted(() => {
        if (localStorage.getItem('authToken')) {
            router.replace('/dashboard');
        }
    });

    const form = reactive({
        login: '',
        password: '',
        remember: false
    });

    const error_message = ref('');

    const loginUser = async ()=>{
        try{
            const response = await axios.post('/api/login', form);
            localStorage.setItem('authToken', response.data.token);
            router.push('/dashboard');
        }catch(error){
            error_message.value = error.response?.data?.message || 'Login failed';
            window.alert("Incorrect Login Credentials!")
        }
    }

</script>