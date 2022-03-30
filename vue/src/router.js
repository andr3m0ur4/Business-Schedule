import { createRouter, createWebHistory } from 'vue-router'
import Home from './views/Home.vue'
import MySchedule from './views/MySchedule.vue'
import Login from './views/Login.vue'
import DefaultLayout from './components/DefaultLayout.vue'

const routes = [
    {
        path: '/',
        redirect: '/home',
        component: DefaultLayout,
        children: [
            { path: '/home', name: 'Home', component: Home },
            { path: '/my-schedule', name: 'MySchedule', component: MySchedule }
        ]
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
