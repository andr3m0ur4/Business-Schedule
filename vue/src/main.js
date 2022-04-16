import { createApp } from 'vue'
import '@/assets/css/backend-plugin.min.css'
import '@/assets/css/backend.css'
import '@/assets/vendor/@fontawesome/fontawesome-free/css/all.min.css'
import '@/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css'
import '@/assets/vendor/remixicon/fonts/remixicon.css'

import store from './store'
import router from './router/routes'
import App from './App.vue'

import axios from 'axios'

window.axios = axios.create({
    baseURL: 'http://localhost:8000/api/',
    headers: {
        Authorization: `Bearer ${sessionStorage.getItem('token')}`
    }
})

import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';

createApp(App)
    .use(router)
    .use(store)
    .use(VueSweetalert2)
    .mount('#app')
