import { RouteRecordRaw } from "vue-router";

const routes: RouteRecordRaw[] = [
  {
    path: "/",
    meta: { requiresAuth: true },
    component: () => import("../layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        name: "home",
        component: () => import("../views/HomeView.vue"),
      },
      {
        path: "/minha-escala",
        name: "my-schedule",
        component: () => import("../views/ScheduleView.vue"),
      },
      {
        path: "/perfil",
        name: "profile",
        component: () => import("../views/ProfileView.vue"),
      },
      {
        path: "/funcoes",
        name: "job",
        component: () => import("../views/JobView.vue"),
      },
      {
        path: "/switcher",
        name: "switcher",
        component: () => import("../views/SwitcherView.vue"),
      },
      {
        path: "/estudios",
        name: "studio",
        component: () => import("../views/StudioView.vue"),
      },
      {
        path: "/mensagens",
        name: "messages",
        component: () => import("../views/MessageView.vue"),
      },
      {
        path: "/programas",
        name: "tvshow",
        component: () => import("../views/TvShowView.vue"),
      },
      {
        path: "/funcionarios",
        name: "employees",
        component: () => import("../views/EmployeeView.vue"),
      },
    ],
  },
  {
    path: "/about",
    name: "about",
    // route level code-splitting
    // this generates a separate chunk (About.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import("../views/AboutView.vue"),
  },
  {
    path: "/entrar",
    name: "sign-in",
    meta: { isGuest: true },
    component: () => import("../views/SignInView.vue"),
  },
  {
    path: "/esqueceu-senha",
    name: "forgot-password",
    meta: { isGuest: true },
    component: () => import("../views/ForgotPasswordView.vue"),
  },
  {
    path: "/confirmar-senha/:token",
    name: "confirm-password",
    meta: { isGuest: true },
    component: () => import("../views/ConfirmPasswordView.vue"),
  },
  {
    path: '/:catchAll(.*)*',
    component: () => import('../views/ErrorNotFound.vue')
  },
];

export default routes
