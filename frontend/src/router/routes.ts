import { RouteRecordRaw } from 'vue-router';

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
        path: '/perfil',
        name: 'profile',
        component: () => import('pages/ProfilePage.vue')
      },
      {
        path: '/funcoes',
        name: 'job',
        component: () => import('pages/JobPage.vue')
      },
      {
        path: '/switcher',
        name: 'switcher',
        component: () => import('pages/SwitcherPage.vue')
      },
      {
        path: '/estudios',
        name: 'studio',
        component: () => import('pages/StudioPage.vue')
      },
      {
        path: '/programas',
        name: 'tvshow',
        component: () => import('pages/TvShowPage.vue')
      },
      {
        path: '/mensagens',
        name: 'messages',
        component: () => import('pages/MessagePage.vue')
      }
    ],
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

  // {
  //     path: '/about',
  //     name: 'about',
  //     // route level code-splitting
  //     // this generates a separate chunk (About.[hash].js) for this route
  //     // which is lazy-loaded when the route is visited.
  //     component: () => import('../views/AboutView.vue')
  // },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
