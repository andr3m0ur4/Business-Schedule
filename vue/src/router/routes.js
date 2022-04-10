import { createRouter, createWebHistory } from 'vue-router'

import DashboardView from '@/views/DashboardView'

const router = createRouter({
    history: createWebHistory(),
    routes: [{
        path: '/',
        component: DashboardView
    }]
})

export default router
