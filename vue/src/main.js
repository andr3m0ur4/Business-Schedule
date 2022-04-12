import { createApp } from 'vue'
import '@/assets/css/backend-plugin.min.css'
import '@/assets/css/backend.css'
import '@/assets/vendor/@fontawesome/fontawesome-free/css/all.min.css'
import '@/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css'
import '@/assets/vendor/remixicon/fonts/remixicon.css'

import router from './router/routes'
import App from './App.vue'

import axios from 'axios'

window.axios = axios.create({
    baseURL: 'http://localhost:8000/api/',
    headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
    }
})

createApp(App)
    .use(router)
    .mount('#app')
