import { createRouter, createWebHistory } from 'vue-router'

import DefaultLayout from '@/components/DefaultLayout'
import DashboardView from '@/views/DashboardView'
import MyScheduleView from '@/views/MyScheduleView'
import AuthSignInView from '@/views/AuthSignInView'
import StudioView from '@/views/StudioView'
import SwitcherView from '@/views/SwitcherView'
import TvShowView from '@/views/TvShowView'
// import store from '@/store'

const routes = [
    {
        path: '/',
        // redirect: '/home',
        meta: { requiresAuth: true },
        component: DefaultLayout,
        children: [
            {
                path: '/',
                name: 'dashboard',
                component: DashboardView
            },
            {
                path: '/my-schedule',
                component: MyScheduleView
            },
            {
                path: '/estudios',
                name: 'studio',
                component: StudioView
            },
            {
                path: '/switcher',
                name: 'switcher',
                component: SwitcherView

            {
                path: '/programas',
                name: 'tvshow',
                component: TvShowView
            }
        ]
    },
    {
        path: '/entrar',
        name: 'sign-in',
        meta: { isGuest: true },
        component: AuthSignInView
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
    } else if (localStorage.getItem('token') && (to.meta.isGuest)) {
        next({ name: 'dashboard'})
    } else {
        next()
    }
})

export default router
