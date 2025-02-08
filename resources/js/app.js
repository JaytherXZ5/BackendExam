import './bootstrap';
import 'boxicons';
import { createApp } from 'vue';
import app from './App.vue';
import router from './router/router.js'

createApp(app).use(router).mount('#app');