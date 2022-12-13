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
        meta: { isAdmin: true },
        component: () => import("../views/HomeView.vue"),
      },
      {
        path: "/minha-escala",
        name: "my-schedule",
        meta: { isAdmin: false },
        component: () => import("../views/ScheduleView.vue"),
      },
      {
        path: "/perfil",
        name: "profile",
        meta: { isAdmin: false },
        component: () => import("../views/ProfileView.vue"),
      },
      {
        path: "/funcoes",
        name: "job",
        meta: { isAdmin: true },
        component: () => import("../views/JobView.vue"),
      },
      {
        path: "/switcher",
        name: "switcher",
        meta: { isAdmin: true },
        component: () => import("../views/SwitcherView.vue"),
      },
      {
        path: "/estudios",
        name: "studio",
        meta: { isAdmin: true },
        component: () => import("../views/StudioView.vue"),
      },
      {
        path: "/mensagens",
        name: "messages",
        meta: { isAdmin: false },
        component: () => import("../views/MessageView.vue"),
      },
      {
        path: "/mensagens/:userIdTo",
        name: "messages-with-id",
        meta: { isAdmin: false },
        component: () => import("../views/MessageView.vue"),
      },
      {
        path: "/programas",
        name: "tvshow",
        meta: { isAdmin: true },
        component: () => import("../views/TvShowView.vue"),
      },
      {
        path: "/funcionarios",
        name: "employees",
        meta: { isAdmin: true },
        component: () => import("../views/EmployeeView.vue"),
      }
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
