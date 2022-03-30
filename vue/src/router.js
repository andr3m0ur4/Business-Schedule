import { createRouter, createWebHistory } from 'vue-router'
import Home from './views/Home.vue'
import MySchedule from './views/MySchedule.vue'
import Login from './views/Login.vue'
import DefaultLayout from './components/DefaultLayout.vue'
import AuthLayout from './components/AuthLayout.vue'
import store from './store'

const routes = [
    {
        path: '/',
        redirect: '/home',
        component: DefaultLayout,
        meta: { requiresAuth: true },
        children: [
            {
                path: '/home',
                name: 'Home',
                component: Home
            },
            {
                path: '/my-schedule',
                name: 'MySchedule',
                component: MySchedule
            }
        ]
    },
    {
        path: '/auth',
        redirect: '/login',
        name: 'Auth',
        component: AuthLayout,
        meta: { isGuest: true },
        children: [
            {
                path: '/login',
                name: 'Login',
                component: Login
            }
        ]
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({ name: 'Login' })
    } else if (store.state.user.token && (to.meta.isGuest)) {
        next({ name: 'Home' })
    } else {
        next()
    }
})

export default router
