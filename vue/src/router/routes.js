import { createRouter, createWebHistory } from 'vue-router'

import DefaultLayout from '@/components/DefaultLayout'
import DashboardView from '@/views/DashboardView'
import MyScheduleView from '@/views/MyScheduleView'
import AuthSignInView from '@/views/AuthSignInView'
import EmployeeView from '@/views/EmployeeView'
import StudioView from '@/views/StudioView'
import SwitcherView from '@/views/SwitcherView'
import TvShowView from '@/views/TvShowView'
import JobView from '@/views/JobView'
import ErrorView from '@/views/ErrorView'
import ForgotPasswordView from '@/views/ForgotPasswordView'
import BlankPage from '@/views/BlankPage'
import ResetPasswordEmail from '@/views/ResetPasswordEmail'
import store from '@/store'

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
                path: '/funcionarios',
                name: 'employees',
                component: EmployeeView
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
            },
            {
                path: '/programas',
                name: 'tvshow',
                component: TvShowView
            },
            {
                path: '/funcoes',
                name: 'job',
                component: JobView
            }
        ]
    },
    {
        path: '/entrar',
        name: 'sign-in',
        meta: { isGuest: true },
        component: AuthSignInView
    },
    {
        path: '/erro',
        name: 'erro',
        component: ErrorView
    },
    {
        path: '/esqueceu-senha',
        name: 'esqueceu-senha',
        component: ForgotPasswordView
    },
    {
        path: '/email',
        name: 'email',
        component: ResetPasswordEmail
    },
    {
        path: '/blank-page',
        name: 'blank-page',
        component: BlankPage
    },
]

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({ name: 'sign-in' })
    } else if (store.state.user.token && (to.meta.isGuest)) {
        next({ name: 'dashboard'})
    } else {
        next()
    }
})

export default router
