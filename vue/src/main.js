import { createApp } from 'vue'
import '@/assets/css/backend-plugin.min.css'
import '@/assets/css/backend.css'
import '@/assets/vendor/@fontawesome/fontawesome-free/css/all.min.css'
import '@/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css'
import '@/assets/vendor/remixicon/fonts/remixicon.css'

import router from './router/routes'
import App from './App.vue'

createApp(App)
    .use(router)
    .mount('#app')
