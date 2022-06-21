import { createApp } from 'vue'
import '@/assets/css/backend-plugin.min.css'
import '@/assets/css/backend.css'
import '@/assets/vendor/@fontawesome/fontawesome-free/css/all.min.css'
import '@/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css'
import '@/assets/vendor/remixicon/fonts/remixicon.css'

import store from './store'
import router from './router/routes'
import App from './App.vue'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
const optionsToast = {
    // You can set your default options here
};

import Storage from 'vue-ls'

const options = {
    namespace: 'vuejs__',
    name: 'ls',
    storage: 'local'
}

createApp(App)
    .use(router)
    .use(store)
    .use(VueSweetalert2)
    .use(Toast, optionsToast)
    .use(Storage, options)
    .mount('#app')
