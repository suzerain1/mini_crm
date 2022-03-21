import { createApp } from 'vue';
import router from './router'
import Home from './components/Home.vue';
import axios from "axios";

import "bootstrap/dist/css/bootstrap.min.css"; 
import "bootstrap";

axios.interceptors.request.use(config => {
    const token = localStorage.getItem("btoken");
    config.headers["Authorization"] = `Bearer ${token}`;
    return config;
});

createApp({
    components: { 
        Home
    }
}).use(router).mount('#app');