import { createRouter, createWebHistory } from 'vue-router'

import DashboardView from '@/views/DashboardView'
import MyScheduleView from '@/views/MyScheduleView'
import AuthSignInView from '@/views/AuthSignInView'

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
            path: '/sign-in',
            component: AuthSignInView
        }
    ]
})

export default router
