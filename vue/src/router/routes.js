import { createRouter, createWebHistory } from 'vue-router'

import DashboardView from '@/views/DashboardView'
import MyScheduleView from '@/views/MyScheduleView'
import AuthSignInView from '@/views/AuthSignInView'
import StudioCreateView from '@/views/StudioCreateView'
// import store from '@/store'

const routes = [
    {
        path: '/',
        name: 'home',
        meta: { requiresAuth: true },
        component: DashboardView
    },
    {
        path: '/my-schedule',
        component: MyScheduleView
    },
    {
        path: '/entrar',
        name: 'sign-in',
        component: AuthSignInView
    },
    {
        path: '/studio/cadastrar',
        component: StudioCreateView
    }
]

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        next({ name: 'sign-in' })
    } else if (localStorage.getItem('token') && (to.name === 'sign-in')) {
        next({ name: 'home'})
    } else {
        next()
    }
})

export default router
