import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue';
import DefaultLayout from '../components/DefaultLayout.vue';
import JobView from '../views/JobView.vue';
import StudioView from '../views/StudioView.vue';
import SignInView from '../views/SignInView.vue';
import { store } from '@/store';

const routes: RouteRecordRaw[] = [
    {
        path: '/',
        meta: { requiresAuth: true },
        component: DefaultLayout,
        children: [
            {
                path: '/',
                name: 'home',
                component: HomeView
            },
            {
                path: '/funcoes',
                name: 'job',
                component: JobView
            },
            {
                path: '/estudios',
                name: 'studio',
                component: StudioView
            }
        ]
    },
    {
        path: '/about',
        name: 'about',
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/AboutView.vue')
    },
    {
        path: '/entrar',
        name: 'sign-in',
        meta: { isGuest: true },
        component: SignInView
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    linkExactActiveClass: 'active',
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.user.token) {
        next({ name: 'sign-in' })
    } else if (store.state.user.user.token && (to.meta.isGuest)) {
        next({ name: 'home'})
    } else {
        next()
    }
});

export default router
