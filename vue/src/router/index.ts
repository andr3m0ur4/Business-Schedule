import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import DefaultLayout from '../components/DefaultLayout.vue';
import ProfileView from '../views/ProfileView.vue';
import JobView from '../views/JobView.vue';
import SwitcherView from '../views/SwitcherView.vue';
import StudioView from '../views/StudioView.vue';
import TvShowView from '../views/TvShowView.vue';
import SignInView from '../views/SignInView.vue';
import ForgotPasswordView from '../views/ForgotPasswordView.vue';
import ConfirmPasswordView from '../views/ConfirmPasswordView.vue';
import MessageView from '../views/MessageView.vue';
import ScheduleView from '../views/ScheduleView.vue';
import { store } from '@/store';

const routes: Array<RouteRecordRaw> = [
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
            path: '/minha-escala',
            name: 'my-schedule',
            component: ScheduleView
        },
        {
            path: '/perfil',
            name: 'profile',
            component: ProfileView
        },
        {
            path: '/funcoes',
            name: 'job',
            component: JobView
        },
        {
            path: '/switcher',
            name: 'switcher',
            component: SwitcherView
        },
        {
            path: '/estudios',
            name: 'studio',
            component: StudioView
        },
        {
            path: '/mensagens',
            name: 'messages',
            component: MessageView
        },
        {
            path: '/programas',
            name: 'tvshow',
            component: TvShowView
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
  },
  {
      path: '/esqueceu-senha',
      name: 'forgot-password',
      meta: { isGuest: true },
      component: ForgotPasswordView
  },
  {
      path: '/confirmar-senha/:token',
      name: 'confirm-password',
      meta: { isGuest: true },
      component: ConfirmPasswordView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  linkExactActiveClass: 'active',
  routes
})

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
