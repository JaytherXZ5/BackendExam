<template>

    <div class="border flex justify-center items-center h-screen w-screen flex-col">
        <h1>LOGIN</h1>
        <div class="">
            <h1>Username or Email</h1>
            <input v-model="form.login" class="border" type="text" required>
        </div>
        <div>
            <h1>Password</h1>
            <input v-model="form.password" class="border" type="password" required>
        </div>
        <div>
            <button @click="loginUser" class="border">LOGIN</button>
        </div>
        <div>
            <h1>Remember me <span> <input v-model="form.remember" type="checkbox"> </span></h1>
        </div>
    </div>

</template>

<script setup>
    import { reactive, ref } from 'vue';
    import axios from 'axios';
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
        }
    }

</script>