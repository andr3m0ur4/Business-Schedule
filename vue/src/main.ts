import { createApp } from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import { key, store } from './store';

import './assets/css/backend-plugin.min.css';
import './assets/css/backend.css';
import './assets/vendor/@fontawesome/fontawesome-free/css/all.min.css';
import './assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css';
import './assets/vendor/remixicon/fonts/remixicon.css';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp(App);
app.use(router);
app.use(store, key);
app.use(VueSweetalert2);

app.mount('#app')
