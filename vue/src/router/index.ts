import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import { store } from "../store";

import routes from "./routes";

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  linkExactActiveClass: "active",
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.user.token) {
    next({ name: "sign-in" });
  } else if (store.state.user.user.token && to.meta.isGuest) {
    next({ name: "home" });
  } else if (store.getters.getUser.type == 'Employee' && to.meta.isAdmin) {
    next({ name: 'my-schedule' });
  } else {
    next();
  }
});

export default router;
