import { createRouter, createWebHistory } from 'vue-router'

import DashboardView from '@/views/DashboardView'
import MyScheduleView from '@/views/MyScheduleView'
import AuthSignInView from '@/views/AuthSignInView'
import StudioCreateView from '@/views/StudioCreateView'

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
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
})

export default router
