import { RouteRecordRaw } from 'vue-router'

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    meta: { requiresAuth: true },
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '',
        name: 'home',
        component: () => import('pages/IndexPage.vue')
      },
      {
        path: 'minha-escala',
        name: 'my-schedule',
        component: () => import('pages/SchedulePage.vue')
      }
    ]
  },
  {
    path: '/entrar',
    name: 'sign-in',
    meta: { isGuest: true },
    component: () => import('pages/SignInPage.vue')
  },
  {
    path: '/esqueceu-senha',
    name: 'forgot-password',
    meta: { isGuest: true },
    component: () => import('pages/ForgotPasswordPage.vue')
  },
  {
    path: '/confirmar-senha/:token',
    name: 'confirm-password',
    meta: { isGuest: true },
    component: () => import('pages/ConfirmPasswordPage.vue')
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
