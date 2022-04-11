import { createRouter, createWebHistory } from 'vue-router'

import DashboardView from '@/views/DashboardView'
import MyScheduleView from '@/views/MyScheduleView'

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
        }
    ]
})

export default router
